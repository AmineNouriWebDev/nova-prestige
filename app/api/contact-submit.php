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
$email = strtolower(trim((string)($input['email'] ?? '')));
$phone = trim((string)($input['phone'] ?? ''));
$country = trim((string)($input['country'] ?? ''));
$service = trim((string)($input['service'] ?? ''));
$mode = trim((string)($input['mode'] ?? ''));
$message = trim((string)($input['message'] ?? $input['description'] ?? ''));
$requestType = trim((string)($input['request_type'] ?? 'projet'));
$rgpd = $input['rgpd'] ?? $input['consent'] ?? null;

// Determine if this is a mini-form submission (has name, email, message but no country field provided)
$isMiniForm = !array_key_exists('country', $input);

// 6. Server-Side Validation
$errors = [];

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

// Phone validation (optional)
if (mb_strlen($phone) > 40) {
    $errors['phone'] = 'Le numéro de téléphone ne doit pas dépasser 40 caractères.';
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
    'Autre'
];
if ($service !== '' && !in_array($service, $allowedServices, true)) {
    $errors['service'] = 'Le domaine d\'intervention sélectionné n\'est pas valide.';
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
$isRgpdChecked = ($rgpd === '1' || $rgpd === 'on' || $rgpd === true || $rgpd === 'true' || $isMiniForm);
if (!$isRgpdChecked) {
    $errors['rgpd'] = 'Vous devez accepter le traitement de vos données pour que nous puissions vous répondre.';
}

// Request type normalization
if (!in_array($requestType, ['projet', 'devis', 'contact'], true)) {
    $requestType = 'projet';
}

if (!empty($errors)) {
    json_response(['errors' => $errors], 422);
}

// 7. Save to contact_requests table
$clientIp = get_client_ip();
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
        'message' => $message,
        'request_type' => $requestType,
        'ip' => $ipBinary,
    ]);
} catch (\Throwable $e) {
    error_log("Failed to save contact request to DB: " . $e->getMessage());
    json_response(['error' => 'Une erreur technique est survenue lors de l\'enregistrement.'], 500);
}

// 8. Send notification email via PHPMailer if SMTP is configured
$smtpHost = $_ENV['SMTP_HOST'] ?? '';
if (!empty($smtpHost) && class_exists(PHPMailer::class)) {
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

        $typeLabel = match ($requestType) {
            'devis' => 'Demande de devis',
            'contact' => 'Message de contact',
            default => 'Nouveau projet',
        };

        $mail->isHTML(true);
        $mail->Subject = "[NOVA PRESTIGE] {$typeLabel} : {$name}";

        $safeName = e($name);
        $safeCompany = e($company ?: 'Non renseignée');
        $safeEmail = e($email);
        $safePhone = e($phone ?: 'Non renseigné');
        $safeCountry = e($country);
        $safeService = e($service ?: 'Non précisé');
        $safeMode = e($mode ?: 'À définir');
        $safeMessage = nl2br(e($message));

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
        <tr><th>E-mail</th><td><a href="mailto:{$safeEmail}">{$safeEmail}</a></td></tr>
        <tr><th>Téléphone</th><td>{$safePhone}</td></tr>
        <tr><th>Pays</th><td>{$safeCountry}</td></tr>
        <tr><th>Domaine d'intervention</th><td>{$safeService}</td></tr>
        <tr><th>Modalité</th><td>{$safeMode}</td></tr>
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
      <p>Nous avons bien reçu votre demande concernant votre projet ou besoin de formation.</p>
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
