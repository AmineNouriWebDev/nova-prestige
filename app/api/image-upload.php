<?php
declare(strict_types=1);

if (!function_exists('json_response')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}

/**
 * NOVA PRESTIGE — Secure Image Upload API Endpoint
 *
 * Verifies admin credentials and CSRF, inspects MIME types with finfo,
 * re-encodes images to WebP via GD (preventing malicious payload execution),
 * generates responsive variants (480w, 960w, 1600w), and updates contents table.
 */

header('X-Robots-Tag: noindex, nofollow');

// Only allow POST
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    json_response(['error' => 'Méthode non autorisée'], 405);
}

// 1. Admin Authentication Check
if (!is_admin()) {
    json_response(['error' => 'Authentification requise'], 401);
}

// 2. CSRF Verification
if (!csrf_verify()) {
    json_response(['error' => 'Jeton CSRF invalide ou expiré'], 403);
}

// Ensure PDO is available
global $pdo;
if (!$pdo instanceof PDO) {
    json_response(['error' => 'Erreur de connexion à la base de données'], 500);
}

// 3. Check uploaded file
if (!isset($_FILES['image']) || !is_array($_FILES['image'])) {
    json_response(['error' => 'Aucun fichier transmis'], 400);
}

$file = $_FILES['image'];
if ($file['error'] !== UPLOAD_ERR_OK) {
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE   => 'Le fichier dépasse la taille maximale autorisée par le serveur.',
        UPLOAD_ERR_FORM_SIZE  => 'Le fichier dépasse la taille maximale autorisée.',
        UPLOAD_ERR_PARTIAL    => 'Le fichier n\'a été que partiellement téléchargé.',
        UPLOAD_ERR_NO_FILE    => 'Aucun fichier n\'a été téléchargé.',
        UPLOAD_ERR_NO_TMP_DIR => 'Dossier temporaire manquant sur le serveur.',
        UPLOAD_ERR_CANT_WRITE => 'Échec de l\'écriture du fichier sur le disque.',
        UPLOAD_ERR_EXTENSION  => 'Une extension PHP a arrêté le téléchargement.',
    ];
    $msg = $errorMessages[$file['error']] ?? 'Erreur lors du téléchargement du fichier.';
    json_response(['error' => $msg], 400);
}

// 4. File size check (max 5 MB)
$maxSize = 5 * 1024 * 1024;
if ($file['size'] > $maxSize) {
    json_response(['error' => 'Le fichier est trop volumineux (maximum 5 Mo).'], 422);
}

// 5. Inspect MIME type with finfo
$tmpPath = (string)$file['tmp_name'];
if (!is_file($tmpPath) || !is_readable($tmpPath)) {
    json_response(['error' => 'Fichier temporaire illisible.'], 400);
}

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->file($tmpPath);

$allowedMimes = [
    'image/jpeg' => 'jpeg',
    'image/png'  => 'png',
    'image/webp' => 'webp',
];

if (!array_key_exists($mimeType, $allowedMimes)) {
    json_response(['error' => 'Format non supporté. Seuls JPG, PNG et WebP sont autorisés.'], 422);
}

// 6. Load image via GD to verify integrity and re-encode
$srcImage = match ($mimeType) {
    'image/jpeg' => @imagecreatefromjpeg($tmpPath),
    'image/png'  => @imagecreatefrompng($tmpPath),
    'image/webp' => @imagecreatefromwebp($tmpPath),
    default      => false,
};

if ($srcImage === false) {
    json_response(['error' => 'Image corrompue ou format non valide.'], 422);
}

$origWidth = imagesx($srcImage);
$origHeight = imagesy($srcImage);

if ($origWidth <= 0 || $origHeight <= 0) {
    imagedestroy($srcImage);
    json_response(['error' => 'Dimensions de l\'image invalides.'], 422);
}

// 7. Prepare destination directory
$rootDir = dirname(__DIR__, 2);
$uploadDir = $rootDir . '/public/uploads';
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
        imagedestroy($srcImage);
        json_response(['error' => 'Impossible de créer le dossier de stockage des images.'], 500);
    }
}

// 8. Generate unique filenames
$baseName = bin2hex(random_bytes(16));
$mainFileName = $baseName . '.webp';
$mainFilePath = $uploadDir . '/' . $mainFileName;

// Helper function to resize and save WebP
$saveResizedWebp = function (\GdImage $src, int $targetW, string $destPath, int $srcW, int $srcH): bool {
    // If original is smaller, maintain original size
    $w = min($targetW, $srcW);
    $h = (int)round($w * ($srcH / $srcW));

    $dst = imagecreatetruecolor($w, $h);
    if ($dst === false) {
        return false;
    }

    // Preserve alpha channel
    imagealphablending($dst, false);
    imagesavealpha($dst, true);

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $srcW, $srcH);
    $res = imagewebp($dst, $destPath, 85);
    imagedestroy($dst);
    return $res;
};

// Generate main image
$saveResizedWebp($srcImage, min(2400, $origWidth), $mainFilePath, $origWidth, $origHeight);

// Generate variants: 480w, 960w, 1600w
$variantFiles = [];
$variants = [480, 960, 1600];
foreach ($variants as $vw) {
    $varFileName = "{$baseName}-{$vw}w.webp";
    $varFilePath = $uploadDir . '/' . $varFileName;
    $saveResizedWebp($srcImage, $vw, $varFilePath, $origWidth, $origHeight);
    $variantFiles[$vw] = '/uploads/' . $varFileName;
}

imagedestroy($srcImage);

// 9. Formulate URL and srcset
$mainUrl = '/uploads/' . $mainFileName;
$srcset = "/uploads/{$baseName}-480w.webp 480w, /uploads/{$baseName}-960w.webp 960w, /uploads/{$baseName}-1600w.webp 1600w";

// 10. Update database if page_key and field_key provided
$fieldKey = trim((string)($_POST['field_key'] ?? ''));
$pageKey = trim((string)($_POST['page_key'] ?? 'home'));
$alt = trim((string)($_POST['alt'] ?? ''));
$lang = strtolower(trim((string)($_POST['lang'] ?? 'fr')));
if ($lang === '') {
    $lang = 'fr';
}

if ($fieldKey !== '' && $pageKey !== '') {
    try {
        $keysToSync = [$fieldKey];
        if (str_starts_with($fieldKey, $pageKey . '.')) {
            $keysToSync[] = substr($fieldKey, strlen($pageKey) + 1);
        } else {
            $keysToSync[] = $pageKey . '.' . $fieldKey;
        }

        // Common aliases mapping
        $aliases = [
            'home.hero.image' => 'hero.image',
            'hero.image' => 'home.hero.image',
            'home.training.image' => 'training.image',
            'training.image' => 'home.training.image',
            'home.zones.image' => 'zones.image',
            'zones.image' => 'home.zones.image',
            'home.services.s1_image' => 'services.s1_image',
            'services.s1_image' => 'home.services.s1_image',
            'home.services.s2_image' => 'services.s2_image',
            'services.s2_image' => 'home.services.s2_image',
            'home.services.s3_image' => 'services.s3_image',
            'services.s3_image' => 'home.services.s3_image',
            'home.services.s4_image' => 'services.s4_image',
            'services.s4_image' => 'home.services.s4_image',
            'home.services.s5_image' => 'services.s5_image',
            'services.s5_image' => 'home.services.s5_image',
            'home.services.s6_image' => 'services.s6_image',
            'services.s6_image' => 'home.services.s6_image',
        ];
        if (isset($aliases[$fieldKey])) {
            $keysToSync[] = $aliases[$fieldKey];
        }

        $keysToSync = array_unique(array_filter($keysToSync));

        foreach ($keysToSync as $syncKey) {
            $stmt = $pdo->prepare(
                "INSERT INTO contents (page_key, field_key, lang, type, value, alt, updated_at)
                 VALUES (:page_key, :field_key, :lang, 'image', :value, :alt, NOW())
                 ON DUPLICATE KEY UPDATE
                   type = 'image',
                   value = VALUES(value),
                   alt = VALUES(alt),
                   updated_at = NOW()"
            );
            $stmt->execute([
                'page_key' => $pageKey,
                'field_key' => $syncKey,
                'lang' => $lang,
                'value' => $mainUrl,
                'alt' => $alt,
            ]);
        }
    } catch (\Throwable $e) {
        error_log("Failed to save image path to contents table: " . $e->getMessage());
    }
}

json_response([
    'success' => true,
    'message' => 'Image uploadée et optimisée avec succès',
    'src' => $mainUrl,
    'srcset' => $srcset,
    'alt' => $alt,
    'page_key' => $pageKey,
    'field_key' => $fieldKey,
]);
