<?php
declare(strict_types=1);

if (!function_exists('json_response')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}

/**
 * NOVA PRESTIGE — Content Save API Endpoint
 *
 * Allows authenticated administrators to update text, richtext, link, or image
 * entries in the contents database table with strict HTML sanitization.
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

// 3. Parse input
$rawBody = file_get_contents('php://input');
$input = json_decode($rawBody, true);
if (!is_array($input)) {
    $input = $_POST;
}

$page_key = trim((string)($input['page_key'] ?? ''));
$field_key = trim((string)($input['field_key'] ?? ''));
$lang = strtolower(trim((string)($input['lang'] ?? 'fr')));
$type = strtolower(trim((string)($input['type'] ?? 'text')));
$value = (string)($input['value'] ?? '');
$alt = isset($input['alt']) ? trim((string)$input['alt']) : null;

// 4. Validate fields
if ($page_key === '' || strlen($page_key) > 60) {
    json_response(['error' => 'La clé de page est obligatoire (max 60 caractères).'], 422);
}

if ($field_key === '' || strlen($field_key) > 120) {
    json_response(['error' => 'La clé de champ est obligatoire (max 120 caractères).'], 422);
}

if (strlen($lang) < 2 || strlen($lang) > 5) {
    $lang = 'fr';
}

$allowedTypes = ['text', 'richtext', 'image', 'link'];
if (!in_array($type, $allowedTypes, true)) {
    json_response(['error' => 'Type de contenu invalide.'], 422);
}

// 5. Sanitize value according to type
if ($type === 'text') {
    $value = strip_tags($value);
} elseif ($type === 'richtext') {
    // Whitelist tags only: strong, em, br, a, ul, li, ol, p
    $allowedTags = '<strong><em><br><a><ul><li><ol><p>';
    $stripped = strip_tags($value, $allowedTags);

    // Clean <a> tags: allow href only, forbid javascript: or data:
    $cleaned = preg_replace_callback('/<a\b([^>]*)>/i', function ($matches) {
        $attrs = $matches[1];
        if (preg_match('/href=([\'"])(.*?)\1/i', $attrs, $hrefMatch)) {
            $href = trim($hrefMatch[2]);
            if (preg_match('/^(javascript|vbscript|data):/i', $href)) {
                return '<a>';
            }
            return '<a href="' . htmlspecialchars($href, ENT_QUOTES | ENT_HTML5, 'UTF-8') . '" target="_blank" rel="noopener noreferrer">';
        }
        return '<a>';
    }, $stripped);

    // Strip all attributes from non-anchor allowed tags
    $value = (string)preg_replace('/<(strong|em|br|ul|li|ol|p)\b[^>]*>/i', '<$1>', $cleaned);
} elseif ($type === 'link') {
    $value = filter_var($value, FILTER_SANITIZE_URL);
} elseif ($type === 'image') {
    $value = trim(strip_tags($value));
}

if ($alt !== null) {
    $alt = mb_substr(strip_tags($alt), 0, 255);
}

// 6. Save to database
try {
    if ($alt !== null) {
        $stmt = $pdo->prepare(
            "INSERT INTO contents (page_key, field_key, lang, type, value, alt, updated_at)
             VALUES (:page_key, :field_key, :lang, :type, :value, :alt, NOW())
             ON DUPLICATE KEY UPDATE
               type = VALUES(type),
               value = VALUES(value),
               alt = VALUES(alt),
               updated_at = NOW()"
        );
        $stmt->execute([
            'page_key' => $page_key,
            'field_key' => $field_key,
            'lang' => $lang,
            'type' => $type,
            'value' => $value,
            'alt' => $alt,
        ]);
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO contents (page_key, field_key, lang, type, value, updated_at)
             VALUES (:page_key, :field_key, :lang, :type, :value, NOW())
             ON DUPLICATE KEY UPDATE
               type = VALUES(type),
               value = VALUES(value),
               updated_at = NOW()"
        );
        $stmt->execute([
            'page_key' => $page_key,
            'field_key' => $field_key,
            'lang' => $lang,
            'type' => $type,
            'value' => $value,
        ]);
    }

    json_response([
        'success' => true,
        'message' => 'Contenu enregistré avec succès',
        'data' => [
            'page_key' => $page_key,
            'field_key' => $field_key,
            'lang' => $lang,
            'type' => $type,
            'value' => $value,
            'alt' => $alt,
        ]
    ]);
} catch (\Throwable $e) {
    error_log("Content save error: " . $e->getMessage());
    json_response(['error' => 'Erreur lors de l\'enregistrement en base de données.'], 500);
}
