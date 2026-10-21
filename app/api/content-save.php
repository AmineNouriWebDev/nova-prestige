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

// Support SEO Modal bulk save
if (isset($input['seo']) && is_array($input['seo'])) {
    if ($page_key === '') {
        $page_key = 'home';
    }
    $seoTitle = trim(strip_tags((string)($input['seo']['title'] ?? '')));
    $seoDesc = trim(strip_tags((string)($input['seo']['description'] ?? '')));
    
    $seoTitleKey = $page_key === 'home' ? 'seo.title' : "seo.{$page_key}.title";
    $seoDescKey = $page_key === 'home' ? 'seo.description' : "seo.{$page_key}.description";

    $stmt = $pdo->prepare(
        "INSERT INTO contents (page_key, field_key, lang, type, value, updated_at)
         VALUES (:page_key, :field_key, :lang, 'text', :value, NOW())
         ON DUPLICATE KEY UPDATE type='text', value=VALUES(value), updated_at=NOW()"
    );

    if ($seoTitle !== '') {
        $stmt->execute(['page_key' => $page_key, 'field_key' => $seoTitleKey, 'lang' => $lang, 'value' => $seoTitle]);
        if ($page_key !== 'home') {
            $stmt->execute(['page_key' => 'global', 'field_key' => $seoTitleKey, 'lang' => $lang, 'value' => $seoTitle]);
        }
    }
    if ($seoDesc !== '') {
        $stmt->execute(['page_key' => $page_key, 'field_key' => $seoDescKey, 'lang' => $lang, 'value' => $seoDesc]);
        if ($page_key !== 'home') {
            $stmt->execute(['page_key' => 'global', 'field_key' => $seoDescKey, 'lang' => $lang, 'value' => $seoDesc]);
        }
    }

    json_response(['success' => true, 'message' => 'Balises SEO enregistrées avec succès']);
}

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
    // Collect keys to synchronize (full, short, and aliases)
    $keysToSync = [$field_key];
    if (str_starts_with($field_key, $page_key . '.')) {
        $keysToSync[] = substr($field_key, strlen($page_key) + 1);
    } else {
        $keysToSync[] = $page_key . '.' . $field_key;
    }

    // Common aliases mapping
    $knownAliases = [
        'home.why.item1_title' => 'home.why.p1_title',
        'home.why.item1_text' => 'home.why.p1_desc',
        'home.why.item2_title' => 'home.why.p2_title',
        'home.why.item2_text' => 'home.why.p2_desc',
        'home.why.item3_title' => 'home.why.p3_title',
        'home.why.item3_text' => 'home.why.p3_desc',
        'home.why.item4_title' => 'home.why.p4_title',
        'home.why.item4_text' => 'home.why.p4_desc',
        'home.hero.cta_project' => 'home.hero.cta_primary',
        'home.hero.cta_quote' => 'home.hero.cta_secondary',
    ];
    if (isset($knownAliases[$field_key])) {
        $alias = $knownAliases[$field_key];
        $keysToSync[] = $alias;
        if (str_starts_with($alias, $page_key . '.')) {
            $keysToSync[] = substr($alias, strlen($page_key) + 1);
        }
    }

    $keysToSync = array_unique(array_filter($keysToSync));

    foreach ($keysToSync as $syncKey) {
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
                'field_key' => $syncKey,
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
                'field_key' => $syncKey,
                'lang' => $lang,
                'type' => $type,
                'value' => $value,
            ]);
        }
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
