<?php
declare(strict_types=1);

if (!function_exists('json_response')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}

/**
 * NOVA PRESTIGE — Contact and Quote Request Submission API Endpoint
 *
 * Implements anti-spam protections (honeypot, signed timestamp token, rate limiting),
 * performs comprehensive server-side field validation, persists the submission to the
 * contact_requests database table, and dispatches notification and auto-reply emails
 * via PHPMailer when SMTP is configured.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

header('X-Robots-Tag: noindex, nofollow');

// Only allow POST
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    json_response(['error' => 'Méthode non autorisée'], 405);
}

// Ensure PDO is available
global $pdo;
if (!$pdo instanceof PDO) {
    json_response(['error' => 'Erreur de connexion à la base de données'], 500);
}

// 1. Parse input data (supports JSON or form-data)
$raw = file_get_contents('php://input');
$input = json_decode($raw, true);
if (!is_array($input)) {
    $input = $_POST;
}

// 2. Anti-Spam: Honeypot field (must be empty)
$honeypot = trim((string)($input['website_url'] ?? ''));
if ($honeypot !== '') {
    // Fake success to misdirect automated spammers
    json_response([
        'success' => true,
        'message' => 'Votre demande a bien été envoyée. Nous vous répondrons dans les meilleurs délais.'
    ]);
}

// 3. Anti-Spam: Signed timestamp token (reject submissions faster than 3 seconds)
$token = (string)($input['ts_token'] ?? $input['form_token'] ?? $input['timestamp_token'] ?? $input['token'] ?? '');
if ($token !== '' && !verify_form_token($token, 3, 86400)) {
    json_response([
        'errors' => [
            'form' => 'La soumission est trop rapide ou le formulaire a expiré. Veuillez patienter quelques secondes et réessayer.'
        ]
    ], 422);
}

// 4. IP Rate Limiting: max 5 sends per hour per IP
if (!rate_limit_check($pdo, 'contact_requests', 5, 60)) {
    json_response([
        'errors' => [
            'rate_limit' => 'Trop de messages envoyés depuis votre connexion. Veuillez patienter une heure avant de renouveler votre demande.'
        ]
    ], 429);
}

// 5. Field Extraction & Sanitization
$name = trim((string)($input['name'] ?? ''));
$company = trim((string)($input['company'] ?? ''));
$sector = trim((string)($input['sector'] ?? ''));
$email = strtolower(trim((string)($input['email'] ?? '')));
$phone = trim((string)($input['phone'] ?? ''));
$country = trim((string)($input['country'] ?? ''));
$service = trim((string)($input['service'] ?? ''));
$mode = trim((string)($input['mode'] ?? ''));
$message = trim((string)($input['message'] ?? $input['description'] ?? ''));
$requestType = trim((string)($input['request_type'] ?? 'projet'));
$rgpd = $input['rgpd'] ?? $input['consent'] ?? null;
$projectCity = trim((string)($input['project_city'] ?? ''));
$shelterType = trim((string)($input['shelter_type'] ?? ''));
$dimensions = trim((string)($input['dimensions'] ?? ''));
$dimensionLength = trim((string)($input['length'] ?? ''));
$dimensionWidth = trim((string)($input['width'] ?? ''));
$dimensionHeight = trim((string)($input['height'] ?? ''));
$surface = trim((string)($input['surface'] ?? ''));
$insulation = trim((string)($input['insulation'] ?? ''));
$materials = trim((string)($input['materials'] ?? ''));
$roofType = trim((string)($input['roof_type'] ?? ''));
$finishColor = trim((string)($input['finish_color'] ?? ''));
$budget = trim((string)($input['budget'] ?? ''));
$deadline = trim((string)($input['deadline'] ?? ''));
$siteAddress = trim((string)($input['site_address'] ?? ''));
$additionalInfo = trim((string)($input['additional_info'] ?? ''));

$hasStructuredDimensions = $dimensionLength !== '' || $dimensionWidth !== '' || $dimensionHeight !== '';
if ($hasStructuredDimensions) {
    $dimensions = implode(' × ', array_map(
        static fn(string $value): string => $value === '' ? '—' : $value . ' m',
        [$dimensionLength, $dimensionWidth, $dimensionHeight]
    ));
}

if (!in_array($requestType, ['projet', 'devis', 'contact', 'partenariat', 'abri_etude', 'abri_devis'], true)) {
    $requestType = 'projet';
}

// Determine if this is a mini-form submission (has name, email, message but no country field provided)
$isMiniForm = !array_key_exists('country', $input);

// 6. Server-Side Validation
$errors = [];
$uploadedFiles = [];
$attachmentField = $_FILES['attachments'] ?? null;
$isShelterRequest = in_array($requestType, ['abri_etude', 'abri_devis'], true);

if ($attachmentField !== null) {
    if (!$isShelterRequest || !is_array($attachmentField['name'] ?? null)) {
        $errors['attachments'] = 'Les pièces jointes sont réservées aux demandes d’étude ou de devis pour un abri.';
    } else {
        $fileCount = count(array_filter(
            $attachmentField['error'] ?? [],
            static fn($error): bool => (int)$error !== UPLOAD_ERR_NO_FILE
        ));
        if ($fileCount > 4) {
            $errors['attachments'] = 'Vous pouvez joindre au maximum 4 fichiers.';
        }

        $allowedMimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'application/pdf' => 'pdf',
        ];
        $totalFileSize = 0;
        $fileInfo = new finfo(FILEINFO_MIME_TYPE);

        foreach ($attachmentField['name'] as $index => $originalName) {
            $uploadError = (int)($attachmentField['error'][$index] ?? UPLOAD_ERR_NO_FILE);
            if ($uploadError === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            if ($uploadError !== UPLOAD_ERR_OK) {
                $errors['attachments'] = 'Un fichier n’a pas pu être téléversé. Vérifiez sa taille et réessayez.';
                continue;
            }

            $temporaryPath = (string)($attachmentField['tmp_name'][$index] ?? '');
            $fileSize = (int)($attachmentField['size'][$index] ?? 0);
            $totalFileSize += $fileSize;

            if ($fileSize < 1 || $fileSize > 2 * 1024 * 1024) {
                $errors['attachments'] = 'Chaque fichier doit peser au maximum 2 Mo.';
                continue;
            }
            if (!is_uploaded_file($temporaryPath)) {
                $errors['attachments'] = 'Un fichier transmis n’est pas valide.';
                continue;
            }

            $mimeType = $fileInfo->file($temporaryPath);
            if (!is_string($mimeType) || !isset($allowedMimeTypes[$mimeType])) {
                $errors['attachments'] = 'Formats acceptés : JPG, PNG, WebP et PDF.';
                continue;
            }

            $safeOriginalName = basename(str_replace('\\', '/', (string)$originalName));
            $safeOriginalName = preg_replace('/[\x00-\x1F\x7F]/u', '', $safeOriginalName) ?: 'document';
            $uploadedFiles[] = [
                'temporary_path' => $temporaryPath,
                'original_name' => mb_substr($safeOriginalName, 0, 180),
                'extension' => $allowedMimeTypes[$mimeType],
                'mime_type' => $mimeType,
                'size' => $fileSize,
            ];
        }

        if ($totalFileSize > 8 * 1024 * 1024) {
            $errors['attachments'] = 'La taille totale des pièces jointes ne doit pas dépasser 8 Mo.';
        }
    }
}

// Name validation
if ($name === '') {
    $errors['name'] = 'Le nom est obligatoire.';
} elseif (mb_strlen($name) > 120) {
    $errors['name'] = 'Le nom ne doit pas dépasser 120 caractères.';
}

// Email validation
if ($email === '') {
    $errors['email'] = 'L\'adresse e-mail est obligatoire.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'L\'adresse e-mail n\'est pas valide.';
} elseif (mb_strlen($email) > 160) {
    $errors['email'] = 'L\'adresse e-mail ne doit pas dépasser 160 caractères.';
}

// Company validation (optional)
if (mb_strlen($company) > 160) {
    $errors['company'] = 'Le nom de l\'entreprise ne doit pas dépasser 160 caractères.';
}
if ($requestType === 'partenariat' && $company === '') {
    $errors['company'] = 'Le nom de l’entreprise est obligatoire pour une proposition de partenariat.';
}
if (mb_strlen($sector) > 160) {
    $errors['sector'] = 'Le secteur d’activité ne doit pas dépasser 160 caractères.';
} elseif ($requestType === 'partenariat' && $sector === '') {
    $errors['sector'] = 'Le secteur d’activité est obligatoire pour une proposition de partenariat.';
}

// Phone validation (optional)
if (mb_strlen($phone) > 40) {
    $errors['phone'] = 'Le numéro de téléphone ne doit pas dépasser 40 caractères.';
}
if ($isShelterRequest && $phone === '') {
    $errors['phone'] = 'Le numéro de téléphone est obligatoire pour votre demande.';
}

$shelterTypes = [
    'Abri de jardin métallique',
    'Atelier de jardin',
    'Atelier ou local de rangement',
    'Local technique pour piscine',
    'Bureau ou studio de jardin',
    'Local de rangement',
    'Construction métallique personnalisée',
    'Autre',
];
$shelterFieldLimits = [
    'project_city' => [$projectCity, 120, 'La ville du projet'],
    'shelter_type' => [$shelterType, 100, 'Le type de construction'],
    'dimensions' => [$dimensions, 160, 'Les dimensions'],
    'surface' => [$surface, 40, 'La surface'],
    'insulation' => [$insulation, 40, 'Le choix de l’isolation'],
    'materials' => [$materials, 240, 'Les matériaux et finitions'],
    'roof_type' => [$roofType, 100, 'Le type de toiture'],
    'finish_color' => [$finishColor, 120, 'La couleur ou finition'],
    'budget' => [$budget, 100, 'Le budget'],
    'deadline' => [$deadline, 100, 'Le délai souhaité'],
    'site_address' => [$siteAddress, 240, 'L’adresse du chantier'],
    'additional_info' => [$additionalInfo, 3000, 'Les informations complémentaires'],
];
foreach ($shelterFieldLimits as $field => [$value, $maxLength, $label]) {
    if (mb_strlen($value) > $maxLength) {
        $errors[$field] = "{$label} ne doit pas dépasser {$maxLength} caractères.";
    }
}
if ($isShelterRequest) {
    foreach (['project_city' => 'La ville du projet', 'shelter_type' => 'Le type de construction', 'dimensions' => 'Les dimensions', 'insulation' => 'Le choix de l’isolation'] as $field => $label) {
        $value = match ($field) {
            'project_city' => $projectCity,
            'shelter_type' => $shelterType,
            'dimensions' => $dimensions,
            default => $insulation,
        };
        if ($value === '') {
            if ($field === 'dimensions' && !$hasStructuredDimensions) {
                foreach (['length', 'width', 'height'] as $dimensionField) {
                    $errors[$dimensionField] = 'Veuillez renseigner les dimensions.';
                }
            } else {
                $errors[$field] = $field === 'dimensions'
                    ? 'Les dimensions sont obligatoires.'
                    : "{$label} est obligatoire.";
            }
        }
    }
    if ($shelterType !== '' && !in_array($shelterType, $shelterTypes, true)) {
        $errors['shelter_type'] = 'Le type de construction sélectionné n’est pas valide.';
    }
    if ($insulation !== '' && !in_array($insulation, ['Avec isolation', 'Sans isolation', 'À définir'], true)) {
        $errors['insulation'] = 'Le choix de l’isolation n’est pas valide.';
    }
    foreach (['length' => $dimensionLength, 'width' => $dimensionWidth, 'height' => $dimensionHeight] as $field => $value) {
        if ($hasStructuredDimensions && $value === '') {
            $errors[$field] = 'Cette dimension est obligatoire.';
        } elseif ($value !== '' && (!is_numeric($value) || (float)$value <= 0 || (float)$value > 999)) {
            $errors[$field] = 'Veuillez indiquer une dimension valide en mètres.';
        }
    }
}
if ($requestType === 'abri_etude' && $deadline === '') {
    $errors['deadline'] = 'Veuillez indiquer le délai souhaité.';
}
if ($requestType === 'abri_devis') {
    if ($siteAddress === '') {
        $errors['site_address'] = 'L’adresse du chantier est obligatoire pour une demande de devis.';
    }
    if ($materials === '') {
        $errors['materials'] = 'Veuillez préciser les matériaux et finitions souhaités.';
    }
    if ($roofType === '') {
        $errors['roof_type'] = 'Veuillez préciser le type de toiture.';
    }
    if ($surface !== '' && (!is_numeric($surface) || (float)$surface <= 0 || (float)$surface > 9999)) {
        $errors['surface'] = 'Veuillez indiquer une surface valide en mètres carrés.';
    }
}

// Country validation
$allowedCountries = [
    'France',
    'Tunisie',
    'Algérie',
    'Maroc',
    'Libye',
    'Mauritanie',
    'Autre'
];
if ($isMiniForm && $country === '') {
    $country = 'France'; // Default country for mini-form
} elseif ($country === '') {
    $errors['country'] = 'Veuillez sélectionner un pays.';
} elseif (!in_array($country, $allowedCountries, true)) {
    $errors['country'] = 'Le pays sélectionné n\'est pas valide.';
}

// Service validation (optional or recommended)
$allowedServices = [
    'Bureau d\'études & faisabilité',
    'Prototypes & développement de produits',
    'Façades métalliques, bardage & calepinage',
    'Méthodes & industrialisation',
    'Conseil industriel & équipements',
    'Formation technique sur site',
    'Financement ou acquisition de machines et équipements',
    'Partenariat industriel et moyens de production',
    'Atelier de prototypage en France',
    'Unité de production en Tunisie',
    'Partenariat commercial et développement de produits',
    'Autre'
];
if ($service !== '' && !in_array($service, $allowedServices, true)) {
    $errors['service'] = 'Le domaine d\'intervention sélectionné n\'est pas valide.';
} elseif ($requestType === 'partenariat' && $service === '') {
    $errors['service'] = 'Veuillez sélectionner le type de partenariat envisagé.';
}

// Mode validation (optional)
$allowedModes = [
    'Sur site',
    'À distance',
    'À définir',
    'sur_site',
    'a_distance',
    'a_definir'
];
if ($mode !== '' && !in_array($mode, $allowedModes, true)) {
    $mode = 'À définir';
}

// Message / Description validation (min 20 chars)
if ($message === '') {
    $errors['message'] = 'La description de votre besoin est obligatoire.';
} elseif (mb_strlen($message) < 20) {
    $errors['message'] = 'Veuillez décrire votre projet de manière plus détaillée (au moins 20 caractères).';
}

// RGPD validation
$isRgpdChecked = ($rgpd === '1' || $rgpd === 'on' || $rgpd === true || $rgpd === 'true' || ($isMiniForm && !in_array($requestType, ['partenariat', 'abri_etude', 'abri_devis'], true)));
if (!$isRgpdChecked) {
    $errors['rgpd'] = 'Vous devez accepter le traitement de vos données pour que nous puissions vous répondre.';
}

if (!empty($errors)) {
    json_response(['errors' => $errors], 422);
}

// 7. Save to contact_requests table
$clientIp = get_client_ip();
$messageDetails = [];
if ($requestType === 'partenariat') {
    $messageDetails[] = "Secteur d’activité : {$sector}";
}
if ($isShelterRequest) {
    $messageDetails[] = "Ville du projet : {$projectCity}";
    $messageDetails[] = "Type de construction : {$shelterType}";
    $messageDetails[] = "Dimensions : {$dimensions}";
    $messageDetails[] = "Isolation : {$insulation}";
    if ($surface !== '') {
        $messageDetails[] = "Surface approximative : {$surface} m²";
    }
    if ($materials !== '') {
        $messageDetails[] = "Matériaux et finitions : {$materials}";
    }
    if ($roofType !== '') {
        $messageDetails[] = "Type de toiture : {$roofType}";
    }
    if ($finishColor !== '') {
        $messageDetails[] = "Couleur ou finition souhaitée : {$finishColor}";
    }
    if ($budget !== '') {
        $messageDetails[] = "Budget envisagé : {$budget}";
    }
    if ($deadline !== '') {
        $messageDetails[] = "Délai souhaité : {$deadline}";
    }
    if ($siteAddress !== '') {
        $messageDetails[] = "Adresse du chantier : {$siteAddress}";
    }
    if ($additionalInfo !== '') {
        $messageDetails[] = "Informations complémentaires : {$additionalInfo}";
    }
}
$messageDetails[] = $message;

$attachmentDirectory = dirname(__DIR__, 2) . '/storage/contact-attachments';
$savedAttachments = [];
if ($uploadedFiles !== []) {
    if (!is_dir($attachmentDirectory) && !mkdir($attachmentDirectory, 0700, true) && !is_dir($attachmentDirectory)) {
        error_log('Failed to create private contact attachment directory.');
        json_response(['error' => 'Une erreur technique empêche le traitement des pièces jointes.'], 500);
    }
    foreach (glob($attachmentDirectory . '/*') ?: [] as $existingFile) {
        $existingName = basename($existingFile);
        if (!is_file($existingFile) || !preg_match('/^(\d{8})_[a-f0-9]{48}\.(jpg|png|webp|pdf)$/', $existingName, $existingMatches)) {
            continue;
        }
        $existingDate = DateTimeImmutable::createFromFormat('!Ymd', $existingMatches[1]);
        if ($existingDate && $existingDate < new DateTimeImmutable('today -7 days')) {
            unlink($existingFile);
        }
    }
    foreach ($uploadedFiles as $uploadedFile) {
        $storedName = date('Ymd') . '_' . bin2hex(random_bytes(24)) . '.' . $uploadedFile['extension'];
        $storedPath = $attachmentDirectory . '/' . $storedName;
        if (!move_uploaded_file($uploadedFile['temporary_path'], $storedPath)) {
            foreach ($savedAttachments as $savedAttachment) {
                unlink($savedAttachment['path']);
            }
            error_log('Failed to move an uploaded contact attachment.');
            json_response(['error' => 'Un fichier n’a pas pu être enregistré. Veuillez réessayer.'], 500);
        }
        $savedAttachments[] = [
            'path' => $storedPath,
            'stored_name' => $storedName,
            'original_name' => $uploadedFile['original_name'],
            'mime_type' => $uploadedFile['mime_type'],
        ];
    }
    chmod($attachmentDirectory, 0700);
}

$attachmentLinks = [];
foreach ($savedAttachments as $savedAttachment) {
    $downloadUrl = url('/api/contact-attachment') . '?file=' . rawurlencode($savedAttachment['stored_name'])
        . '&name=' . rawurlencode($savedAttachment['original_name']);
    $attachmentLinks[] = $savedAttachment + ['url' => $downloadUrl];
    $messageDetails[] = 'Pièce jointe : ' . $savedAttachment['original_name'] . ' — ' . $downloadUrl;
}
$storedMessage = implode("\n", array_filter($messageDetails, static fn(string $line): bool => $line !== ''));
$ipBinary = @inet_pton($clientIp);
if ($ipBinary === false) {
    $ipBinary = inet_pton('127.0.0.1');
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO contact_requests (name, company, email, phone, country, service, mode, message, request_type, ip, created_at)
         VALUES (:name, :company, :email, :phone, :country, :service, :mode, :message, :request_type, :ip, NOW())"
    );
    $stmt->execute([
        'name' => $name,
        'company' => $company !== '' ? $company : null,
        'email' => $email,
        'phone' => $phone !== '' ? $phone : null,
        'country' => $country,
        'service' => $service !== '' ? $service : null,
        'mode' => $mode !== '' ? $mode : null,
        'message' => $storedMessage,
        'request_type' => $requestType,
        'ip' => $ipBinary,
    ]);
} catch (\Throwable $e) {
    foreach ($savedAttachments as $savedAttachment) {
        unlink($savedAttachment['path']);
    }
    error_log("Failed to save contact request to DB: " . $e->getMessage());
    json_response(['error' => 'Une erreur technique est survenue lors de l\'enregistrement.'], 500);
}

// 8. Determine readable request type label
$typeLabel = match ($requestType) {
    'devis' => 'Demande de devis',
    'contact' => 'Message de contact',
    'partenariat' => 'Proposition de partenariat',
    'abri_etude' => 'Demande d’étude — abri métallique',
    'abri_devis' => 'Demande de devis — abri métallique',
    default => 'Étude de projet',
};

// 9. Forward submission to n8n automation webhook
$n8nWebhookUrl = $_ENV['N8N_WEBHOOK_URL'] ?? 'https://n8n.deposark.com/webhook/aef80550-6348-402a-9718-fe58c5745b59';
if (!empty($n8nWebhookUrl)) {
    $n8nPayload = [
        'nom' => $name,
        'name' => $name,
        'entreprise' => $company !== '' ? $company : 'Non renseignée',
        'company' => $company,
        'secteur_activite' => $sector,
        'email' => $email,
        'telephone' => $phone !== '' ? $phone : 'Non renseigné',
        'phone' => $phone,
        'pays' => $country,
        'country' => $country,
        'service' => $service !== '' ? $service : ($shelterType !== '' ? $shelterType : 'Non précisé'),
        'modalite' => $mode !== '' ? $mode : 'À définir',
        'mode' => $mode !== '' ? $mode : 'À définir',
        'type_demande' => $typeLabel,
        'request_type' => $requestType,
        'ville_projet' => $projectCity,
        'adresse_chantier' => $siteAddress,
        'longueur' => $dimensionLength,
        'largeur' => $dimensionWidth,
        'hauteur' => $dimensionHeight,
        'surface' => $surface,
        'isolation' => $insulation,
        'materiaux' => $materials,
        'type_toiture' => $roofType,
        'couleur_finition' => $finishColor,
        'budget' => $budget,
        'delai_souhaite' => $deadline,
        'pieces_jointes' => array_map(
            static fn(array $attachment): array => ['nom' => $attachment['original_name'], 'url' => $attachment['url']],
            $attachmentLinks
        ),
        'sujet' => "Demande {$typeLabel} - " . ($service !== '' ? $service : ($shelterType !== '' ? $shelterType : 'Général')),
        'message' => $storedMessage,
        'date' => date('d/m/Y à H:i'),
        'ip' => $clientIp,
        'source' => parse_url($_ENV['APP_URL'] ?? 'https://novaprestige-industrie.fr', PHP_URL_HOST) ?: 'novaprestige-industrie.fr'
    ];

    try {
        if (function_exists('curl_init')) {
            $ch = curl_init($n8nWebhookUrl);
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($n8nPayload, JSON_UNESCAPED_UNICODE),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Accept: application/json'
                ],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 4,
                CURLOPT_CONNECTTIMEOUT => 2,
                CURLOPT_SSL_VERIFYPEER => true,
            ]);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                error_log("n8n webhook curl error: " . curl_error($ch));
            }
            curl_close($ch);
        } else {
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/json\r\nAccept: application/json\r\n",
                    'content' => json_encode($n8nPayload, JSON_UNESCAPED_UNICODE),
                    'timeout' => 4,
                    'ignore_errors' => true,
                ]
            ]);
            @file_get_contents($n8nWebhookUrl, false, $context);
        }
    } catch (\Throwable $e) {
        error_log("n8n webhook dispatch error: " . $e->getMessage());
    }
}

// 10. Send notification email via PHPMailer if external SMTP is configured
$smtpHost = $_ENV['SMTP_HOST'] ?? '';
$smtpUser = $_ENV['SMTP_USER'] ?? '';
if (!empty($smtpHost) && $smtpHost !== 'localhost' && !empty($smtpUser) && class_exists(PHPMailer::class)) {
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = !empty($_ENV['SMTP_USER']);
        $mail->Username = (string)($_ENV['SMTP_USER'] ?? '');
        $mail->Password = (string)($_ENV['SMTP_PASS'] ?? '');
        $mail->Port = (int)($_ENV['SMTP_PORT'] ?? 587);

        $smtpSecure = strtolower((string)($_ENV['SMTP_SECURE'] ?? 'tls'));
        if ($smtpSecure === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } elseif ($smtpSecure === 'tls') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }

        $mail->CharSet = 'UTF-8';

        $fromEmail = $_ENV['SMTP_FROM'] ?? 'contact@novaprestige.fr';
        $fromName = $_ENV['SMTP_FROM_NAME'] ?? 'NOVA PRESTIGE';
        $mail->setFrom($fromEmail, $fromName);
        $mail->addReplyTo($email, $name);

        $recipientEmail = $_ENV['CONTACT_EMAIL'] ?? 'contact@novaprestige.fr';
        $mail->addAddress($recipientEmail, 'Administration NOVA PRESTIGE');

        $mail->isHTML(true);
        $mail->Subject = "[NOVA PRESTIGE] {$typeLabel} : {$name}";

        $safeName = e($name);
        $safeCompany = e($company ?: 'Non renseignée');
        $safeSector = e($sector ?: 'Non renseigné');
        $safeEmail = e($email);
        $safePhone = e($phone ?: 'Non renseigné');
        $safeCountry = e($country);
        $safeService = e($service ?: ($shelterType !== '' ? $shelterType : 'Non précisé'));
        $safeMode = e($mode ?: 'À définir');
        $safeMessage = nl2br(e($storedMessage));
        $additionalEmailRows = '';
        if ($isShelterRequest) {
            $emailDetails = [
                'Ville du projet' => $projectCity,
                'Dimensions' => $dimensions,
                'Isolation' => $insulation,
                'Surface approximative' => $surface !== '' ? $surface . ' m²' : '',
                'Matériaux et finitions' => $materials,
                'Type de toiture' => $roofType,
                'Couleur ou finition souhaitée' => $finishColor,
                'Budget envisagé' => $budget,
                'Délai souhaité' => $deadline,
                'Adresse du chantier' => $siteAddress,
            ];
            foreach ($emailDetails as $detailLabel => $detailValue) {
                if ($detailValue !== '') {
                    $additionalEmailRows .= '<tr><th>' . e($detailLabel) . '</th><td>' . e($detailValue) . '</td></tr>';
                }
            }
            if ($attachmentLinks !== []) {
                $attachmentList = [];
                foreach ($attachmentLinks as $attachment) {
                    $attachmentList[] = '<a href="' . e($attachment['url']) . '">' . e($attachment['original_name']) . '</a>';
                }
                $additionalEmailRows .= '<tr><th>Documents transmis</th><td>' . implode('<br>', $attachmentList) . '</td></tr>';
            }
        }

        $mail->Body = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #0B1A2B; background: #F4F6F9; margin: 0; padding: 24px; }
    .card { background: #FFFFFF; max-width: 640px; margin: 0 auto; border-radius: 8px; border: 1px solid #D9E0E8; overflow: hidden; }
    .header { background: #12304F; color: #FFFFFF; padding: 24px 32px; border-bottom: 3px solid #C8692E; }
    .header h1 { margin: 0; font-size: 20px; font-weight: 700; letter-spacing: 1px; }
    .header p { margin: 4px 0 0 0; font-size: 13px; color: #9AA8BA; }
    .content { padding: 32px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
    th, td { padding: 10px 12px; text-align: left; font-size: 14px; border-bottom: 1px solid #E8EDF3; }
    th { width: 35%; color: #4A5A6E; font-weight: 600; background: #F8FAFC; }
    .message-box { background: #F8FAFC; border-left: 4px solid #C8692E; padding: 16px 20px; border-radius: 0 4px 4px 0; font-size: 14px; white-space: pre-wrap; word-break: break-word; }
    .footer { padding: 16px 32px; background: #ECEFF4; font-size: 12px; color: #4A5A6E; text-align: center; }
  </style>
</head>
<body>
  <div class="card">
    <div class="header">
      <h1>NOVA PRESTIGE — {$typeLabel}</h1>
      <p>Reçu le date('d/m/Y à H:i') depuis le site web</p>
    </div>
    <div class="content">
      <table>
        <tr><th>Nom complet</th><td><strong>{$safeName}</strong></td></tr>
        <tr><th>Entreprise</th><td>{$safeCompany}</td></tr>
        <tr><th>Secteur d'activité</th><td>{$safeSector}</td></tr>
        <tr><th>E-mail</th><td><a href="mailto:{$safeEmail}">{$safeEmail}</a></td></tr>
        <tr><th>Téléphone</th><td>{$safePhone}</td></tr>
        <tr><th>Pays</th><td>{$safeCountry}</td></tr>
        <tr><th>Domaine d'intervention</th><td>{$safeService}</td></tr>
        <tr><th>Modalité</th><td>{$safeMode}</td></tr>
        {$additionalEmailRows}
      </table>
      <h3 style="font-size: 15px; color: #12304F; margin: 20px 0 10px 0;">Description du besoin :</h3>
      <div class="message-box">{$safeMessage}</div>
    </div>
    <div class="footer">
      Notification générée automatiquement par le site NOVA PRESTIGE
    </div>
  </div>
</body>
</html>
HTML;

        foreach ($savedAttachments as $attachment) {
            $mail->addAttachment($attachment['path'], $attachment['original_name']);
        }
        $mail->send();

        // Send auto-reply to visitor
        $reply = new PHPMailer(true);
        $reply->isSMTP();
        $reply->Host = $smtpHost;
        $reply->SMTPAuth = !empty($_ENV['SMTP_USER']);
        $reply->Username = (string)($_ENV['SMTP_USER'] ?? '');
        $reply->Password = (string)($_ENV['SMTP_PASS'] ?? '');
        $reply->Port = (int)($_ENV['SMTP_PORT'] ?? 587);
        if ($smtpSecure === 'ssl') {
            $reply->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } elseif ($smtpSecure === 'tls') {
            $reply->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        $reply->CharSet = 'UTF-8';
        $reply->setFrom($fromEmail, $fromName);
        $reply->addAddress($email, $name);
        $reply->isHTML(true);
        $reply->Subject = "Confirmation de réception de votre demande — NOVA PRESTIGE";

        $reply->Body = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #0B1A2B; background: #F4F6F9; margin: 0; padding: 24px; }
    .card { background: #FFFFFF; max-width: 600px; margin: 0 auto; border-radius: 8px; border: 1px solid #D9E0E8; overflow: hidden; }
    .header { background: #12304F; color: #FFFFFF; padding: 24px 32px; border-bottom: 3px solid #C8692E; }
    .content { padding: 32px; font-size: 14px; }
    .footer { padding: 16px 32px; background: #ECEFF4; font-size: 12px; color: #4A5A6E; text-align: center; }
  </style>
</head>
<body>
  <div class="card">
    <div class="header">
      <h1 style="margin:0; font-size: 20px;">NOVA PRESTIGE</h1>
      <p style="margin:4px 0 0 0; color: #9AA8BA; font-size: 13px;">Bureau d'études techniques • Conseil industriel • Formation</p>
    </div>
    <div class="content">
      <p>Bonjour <strong>{$safeName}</strong>,</p>
      <p>{$typeLabel} — nous avons bien reçu votre message. Nous l’examinerons avec attention et reviendrons vers vous dans les meilleurs délais.</p>
      <p>Un consultant technique senior examinera votre message avec attention et reviendra vers vous dans les meilleurs délais pour une analyse de faisabilité ou un premier échange de cadrage.</p>
      <p style="margin-top: 24px;">Cordialement,<br><strong>L'équipe NOVA PRESTIGE</strong><br><span style="color:#4A5A6E; font-size:13px;">France • Tunisie • Maghreb</span></p>
    </div>
    <div class="footer">
      NOVA PRESTIGE — Bureau d'études techniques et conseil industriel
    </div>
  </div>
</body>
</html>
HTML;

        $reply->send();
    } catch (MailException $e) {
        error_log("PHPMailer send failed: " . $e->getMessage());
    } catch (\Throwable $e) {
        error_log("Unexpected mail error: " . $e->getMessage());
    }
}

// 9. Return JSON success response
json_response([
    'success' => true,
    'message' => 'Votre demande a bien été envoyée. Nous vous répondrons dans les meilleurs délais.'
]);
