<?php
declare(strict_types=1);

/**
 * NOVA PRESTIGE — Core Helper Functions
 */

/**
 * In-memory content cache loaded from DB and defaults.
 */
class ContentCache
{
    public static array $data = [];
    public static array $settings = [];
    public static bool $bootstrapped = false;
}

if (!function_exists('e')) {
    /**
     * Escape HTML output using htmlspecialchars with ENT_QUOTES and UTF-8.
     */
    function e(?string $str): string
    {
        if ($str === null) {
            return '';
        }
        return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}

if (!function_exists('t')) {
    /**
     * Translate / retrieve content by key and language, or fallback.
     * Can be called as t($key, $fallback) or t($key, $lang).
     */
    function t(string $key, ?string $fallbackOrLang = null, string $lang = 'fr'): string
    {
        global $CONTENT_DEFAULTS;

        $fallback = null;
        if ($fallbackOrLang !== null) {
            if (in_array(strtolower($fallbackOrLang), ['fr', 'en', 'ar', 'es', 'de'], true)) {
                $lang = strtolower($fallbackOrLang);
            } else {
                $fallback = $fallbackOrLang;
            }
        }

        $isValid = function($val): bool {
            return $val !== '' && $val !== null && $val !== 'Array' && $val !== '[Array]';
        };

        // Check in-memory DB cache
        if (isset(ContentCache::$data[$lang][$key]['value'])) {
            $val = ContentCache::$data[$lang][$key]['value'];
            if ($isValid($val)) {
                return (string)$val;
            }
        }
        if (isset(ContentCache::$data['fr'][$key]['value'])) {
            $val = ContentCache::$data['fr'][$key]['value'];
            if ($isValid($val)) {
                return (string)$val;
            }
        }

        // Aliases to seamlessly support both naming variants
        $aliases = [
            'home.hero.supertitle' => 'home.hero.surtitre',
            'home.hero.badge1' => 'home.hero.badge_1',
            'home.hero.badge2' => 'home.hero.badge_2',
            'home.hero.badge3' => 'home.hero.badge_3',
            'home.hero.cta_project' => 'home.hero.cta_primary',
            'home.hero.cta_quote' => 'home.hero.cta_secondary',
            'home.hero.cta1' => 'home.hero.cta_primary',
            'home.hero.cta2' => 'home.hero.cta_secondary',
            'home.hero.cta3' => 'home.hero.cta_contact',
            'home.stats.item1_val' => 'home.stats.val_1',
            'home.stats.item1_label' => 'home.stats.label_1',
            'home.stats.item2_val' => 'home.stats.val_2',
            'home.stats.item2_label' => 'home.stats.label_2',
            'home.stats.item3_val' => 'home.stats.val_3',
            'home.stats.item3_label' => 'home.stats.label_3',
            'home.stats.item4_val' => 'home.stats.val_4',
            'home.stats.item4_label' => 'home.stats.label_4',
            'home.services.s1_text' => 's1.text',
            'home.services.s2_text' => 's2.text',
            'home.services.s3_text' => 's3.text',
            'home.services.s4_text' => 's4.text',
            'home.services.s5_text' => 's5.text',
            'home.services.s6_text' => 's6.text',
            'home.services.s1_title' => 's1.title',
            'home.services.s2_title' => 's2.title',
            'home.services.s3_title' => 's3.title',
            'home.services.s4_title' => 's4.title',
            'home.services.s5_title' => 's5.title',
            'home.services.s6_title' => 's6.title',
            'home.process.step1_title' => 'home.process.step1.title',
            'home.process.step1_text' => 'home.process.step1.text',
            'home.process.step2_title' => 'home.process.step2.title',
            'home.process.step2_text' => 'home.process.step2.text',
            'home.process.step3_title' => 'home.process.step3.title',
            'home.process.step3_text' => 'home.process.step3.text',
            'home.process.step4_title' => 'home.process.step4.title',
            'home.process.step4_text' => 'home.process.step4.text',
            'home.process.step5_title' => 'home.process.step5.title',
            'home.process.step5_text' => 'home.process.step5.text',
            'home.audience.card1_role' => 'home.audience.c1.title',
            'home.audience.card1_text' => 'home.audience.c1.text',
            'home.audience.card2_role' => 'home.audience.c2.title',
            'home.audience.card2_text' => 'home.audience.c2.text',
            'home.audience.card3_role' => 'home.audience.c3.title',
            'home.audience.card3_text' => 'home.audience.c3.text',
            'home.why.item1_title' => 'home.why.p1.title',
            'home.why.item1_text' => 'home.why.p1.text',
            'home.why.item2_title' => 'home.why.p2.title',
            'home.why.item2_text' => 'home.why.p2.text',
            'home.why.item3_title' => 'home.why.p3.title',
            'home.why.item3_text' => 'home.why.p3.text',
            'home.why.item4_title' => 'home.why.p4.title',
            'home.why.item4_text' => 'home.why.p4.text',
            'home.zones.france_text' => 'home.zones.france',
            'home.zones.tunisie_text' => 'home.zones.tunisie',
            'home.zones.maghreb_text' => 'home.zones.maghreb',
            'global.footer.ai_mention' => 'global.footer.ai_notice',
            'home.cta.btn' => 'home.cta.link_text',
            'home.cta.link' => 'home.cta.link_text',
        ];

        $lookupKey = $key;
        if (!empty($CONTENT_DEFAULTS) && !array_key_exists($lookupKey, $CONTENT_DEFAULTS)) {
            if (isset($aliases[$key])) {
                $lookupKey = $aliases[$key];
            } else {
                $flipped = array_flip($aliases);
                if (isset($flipped[$key])) {
                    $lookupKey = $flipped[$key];
                }
            }
        }

        // Fallback to default dictionary
        if (is_array($CONTENT_DEFAULTS) && array_key_exists($lookupKey, $CONTENT_DEFAULTS)) {
            $defaultEntry = $CONTENT_DEFAULTS[$lookupKey];
            if (is_array($defaultEntry)) {
                $val = (string)($defaultEntry['value'] ?? '');
                if ($isValid($val)) {
                    return $val;
                }
            } elseif ($isValid($defaultEntry)) {
                return (string)$defaultEntry;
            }
        }

        // If fallback provided, return it
        if ($fallback !== null && $fallback !== '') {
            return $fallback;
        }

        return '';
    }
}

if (!function_exists('setting')) {
    /**
     * Get a setting from settings table or defaults.
     */
    function setting(string $key, string $default = ''): string
    {
        if (isset(ContentCache::$settings[$key])) {
            $val = ContentCache::$settings[$key];
            if ($val !== 'À compléter' && $val !== 'A completer') {
                return (string)$val;
            }
        }
        return $default;
    }
}

if (!function_exists('img')) {
    /**
     * Retrieve image details by key.
     * Returns associative array: ['src' => string, 'alt' => string]
     * If DB src is empty, falls back to SVG gradient placeholder.
     */
    function img(string $key, string $lang = 'fr'): array
    {
        global $CONTENT_DEFAULTS;

        $src = '';
        $alt = '';

        // Check DB cache
        if (isset(ContentCache::$data[$lang][$key])) {
            $row = ContentCache::$data[$lang][$key];
            $src = trim((string)($row['value'] ?? ''));
            $alt = trim((string)($row['alt'] ?? ''));
        }

        // Default alt if not specified in DB
        if ($alt === '') {
            $altKey = $key . '.alt';
            if (isset(ContentCache::$data[$lang][$altKey]['value'])) {
                $alt = (string)ContentCache::$data[$lang][$altKey]['value'];
            } elseif (is_array($CONTENT_DEFAULTS) && !empty($CONTENT_DEFAULTS[$altKey])) {
                $entry = $CONTENT_DEFAULTS[$altKey];
                $alt = is_array($entry) ? (string)($entry['value'] ?? '') : (string)$entry;
            } elseif (is_array($CONTENT_DEFAULTS) && isset($CONTENT_DEFAULTS[$key]) && is_array($CONTENT_DEFAULTS[$key]) && !empty($CONTENT_DEFAULTS[$key]['alt'])) {
                $alt = (string)$CONTENT_DEFAULTS[$key]['alt'];
            } else {
                $alts = [
                    'home.hero.image' => 'Façade métallique moderne en bardage plié, vue en perspective au crépuscule',
                    'home.training.image' => "Formation pratique au pliage industriel directement dans l'atelier d'une entreprise",
                    'home.zones.image' => "Carte stylisée des zones d'intervention : France, Tunisie et Maghreb",
                    's1.image' => "Plans techniques et modélisation 3D d'un profil métallique sur un bureau d'études",
                    's2.image' => "Pièce métallique pliée et poinçonnée en phase de prototypage",
                    's3.image' => "Détail de calepinage d'un bardage métallique avec joints et raccordements",
                    's4.image' => "Atelier de tôlerie industrielle avec presse plieuse et poinçonneuse",
                    's5.image' => "Diagnostic technique sur site avec les équipes d'un atelier industriel",
                    's6.image' => "Formation pratique au pliage industriel en atelier",
                ];
                $alt = $alts[$key] ?? 'Illustration technique NOVA PRESTIGE';
            }
        }

        // If no src in DB, check defaults
        if ($src === '' && is_array($CONTENT_DEFAULTS) && !empty($CONTENT_DEFAULTS[$key])) {
            $entry = $CONTENT_DEFAULTS[$key];
            $src = is_array($entry) ? trim((string)($entry['value'] ?? '')) : trim((string)$entry);
        }

        // If still empty, return placeholder
        if ($src === '') {
            $src = gradient_placeholder($key);
        }

        return [
            'src' => $src,
            'alt' => $alt,
        ];
    }
}

if (!function_exists('gradient_placeholder')) {
    /**
     * Generate a technical steel-gradient placeholder SVG data URI.
     */
    function gradient_placeholder(string $key): string
    {
        $label = e(strtoupper(str_replace(['.', '_', '-'], ' ', $key)));
        
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 900" width="100%" height="100%">'
             . '<defs>'
             . '<linearGradient id="steelGrad" x1="0%" y1="0%" x2="100%" y2="100%">'
             . '<stop offset="0%" stop-color="#12304F"/>'
             . '<stop offset="100%" stop-color="#1A4070"/>'
             . '</linearGradient>'
             . '<pattern id="techGrid" width="40" height="40" patternUnits="userSpaceOnUse">'
             . '<path d="M 40 0 L 0 0 0 40" fill="none" stroke="#224870" stroke-width="1" opacity="0.35"/>'
             . '</pattern>'
             . '</defs>'
             . '<rect width="1600" height="900" fill="url(#steelGrad)"/>'
             . '<rect width="1600" height="900" fill="url(#techGrid)"/>'
             . '<line x1="80" y1="80" x2="1520" y2="80" stroke="#C8692E" stroke-width="2" opacity="0.6"/>'
             . '<line x1="80" y1="820" x2="1520" y2="820" stroke="#C8692E" stroke-width="2" opacity="0.6"/>'
             . '<circle cx="80" cy="80" r="5" fill="#C8692E"/>'
             . '<circle cx="1520" cy="80" r="5" fill="#C8692E"/>'
             . '<circle cx="80" cy="820" r="5" fill="#C8692E"/>'
             . '<circle cx="1520" cy="820" r="5" fill="#C8692E"/>'
             . '<text x="800" y="430" font-family="Space Grotesk, system-ui, -apple-system, sans-serif" font-weight="700" font-size="32" fill="#E8EDF3" text-anchor="middle" letter-spacing="4">NOVA PRESTIGE</text>'
             . '<text x="800" y="475" font-family="JetBrains Mono, monospace" font-size="14" fill="#9AA8BA" text-anchor="middle" letter-spacing="2">[' . $label . ']</text>'
             . '<text x="800" y="515" font-family="Inter, sans-serif" font-size="14" fill="#C8692E" text-anchor="middle">Illustration en cours de préparation</text>'
             . '</svg>';

        return 'data:image/svg+xml;charset=utf-8,' . rawurlencode($svg);
    }
}

if (!function_exists('url')) {
    /**
     * Generate full URL from relative path.
     */
    function url(string $path = ''): string
    {
        $base = rtrim($_ENV['APP_URL'] ?? '', '/');
        if ($base === '') {
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443) ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $base = "{$scheme}://{$host}";
        }
        
        if ($path === '' || $path === '/') {
            return $base . '/';
        }
        
        return $base . '/' . ltrim($path, '/');
    }
}

if (!function_exists('csrf_token')) {
    /**
     * Generate or retrieve CSRF token from session.
     */
    function csrf_token(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return (string)$_SESSION['csrf_token'];
    }
}

if (!function_exists('csrf_verify')) {
    /**
     * Verify CSRF token from HTTP header X-CSRF-Token or POST _csrf or csrf_token.
     */
    function csrf_verify(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $sessionToken = $_SESSION['csrf_token'] ?? '';
        if (empty($sessionToken)) {
            return false;
        }

        $headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        $postToken = $_POST['_csrf'] ?? $_POST['csrf_token'] ?? '';

        $tokenToVerify = !empty($headerToken) ? $headerToken : $postToken;

        if (empty($tokenToVerify)) {
            $raw = file_get_contents('php://input');
            if (!empty($raw)) {
                $json = json_decode($raw, true);
                if (is_array($json)) {
                    $tokenToVerify = (string)($json['_csrf'] ?? $json['csrf_token'] ?? '');
                }
            }
        }

        if (empty($tokenToVerify)) {
            return false;
        }

        return hash_equals($sessionToken, $tokenToVerify);
    }
}

if (!function_exists('is_admin')) {
    /**
     * Check if current user has an active authenticated admin session.
     */
    function is_admin(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return !empty($_SESSION['admin_user_id']) || !empty($_SESSION['is_admin']);
    }
}

if (!function_exists('seo')) {
    /**
     * Get SEO metadata for a page key: [ 'title' => ..., 'description' => ..., 'canonical' => ... ]
     */
    function seo(string $page_key): array
    {
        $titleKey = "seo.{$page_key}.title";
        $descKey = "seo.{$page_key}.description";

        $title = t($titleKey);
        if ($title === '') {
            $title = t('seo.title');
        }
        if ($title === '') {
            $title = t('seo.home.title');
        }
        if ($title === '') {
            $title = "NOVA PRESTIGE | Bureau d'études, conseil industriel et formation";
        }

        $desc = t($descKey);
        if ($desc === '') {
            $desc = t('seo.description');
        }
        if ($desc === '') {
            $desc = t('seo.home.description');
        }
        if ($desc === '') {
            $desc = "Consultant technique senior : étude de faisabilité industrielle, développement de produits métalliques, calepinage de façades, industrialisation et formation en atelier. France, Tunisie, Maghreb.";
        }

        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

        return [
            'title' => $title,
            'description' => $desc,
            'canonical' => url($path),
        ];
    }
}

if (!function_exists('bootstrap_content_cache')) {
    /**
     * Preload all content rows and settings in ONE database query.
     */
    function bootstrap_content_cache(PDO $pdo, string $page_key): void
    {
        try {
            $stmt = $pdo->prepare(
                "SELECT page_key, field_key, lang, type, value, alt 
                 FROM contents 
                 WHERE page_key IN (?, 'global', 'home')"
            );
            $stmt->execute([$page_key]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $lang = $row['lang'] ?? 'fr';
                $field = $row['field_key'];
                $fullKey = $row['page_key'] . '.' . $field;

                ContentCache::$data[$lang][$field] = [
                    'type' => $row['type'],
                    'value' => $row['value'],
                    'alt' => $row['alt'],
                ];
                ContentCache::$data[$lang][$fullKey] = [
                    'type' => $row['type'],
                    'value' => $row['value'],
                    'alt' => $row['alt'],
                ];
            }

            // Also load settings table
            $settingStmt = $pdo->query("SELECT k, v FROM settings");
            while ($s = $settingStmt->fetch(PDO::FETCH_ASSOC)) {
                ContentCache::$settings[$s['k']] = $s['v'];
            }

            ContentCache::$bootstrapped = true;
        } catch (\Throwable $e) {
            ContentCache::$bootstrapped = false;
            error_log("Failed to bootstrap content cache: " . $e->getMessage());
        }
    }
}

if (!function_exists('current_page_key')) {
    /**
     * Derive page key from current REQUEST_URI.
     */
    function current_page_key(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $path = trim($path, '/');

        if ($path === '' || $path === false) {
            return 'home';
        }

        return match ($path) {
            'contact' => 'contact',
            'mentions-legales' => 'mentions',
            'politique-confidentialite' => 'privacy',
            default => str_replace('/', '.', $path),
        };
    }
}

if (!function_exists('json_response')) {
    /**
     * Output JSON response and terminate execution.
     */
    function json_response(array $data, int $status = 200): never
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=UTF-8');
        header('X-Robots-Tag: noindex, nofollow');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
}

if (!function_exists('get_client_ip')) {
    /**
     * Safely obtain real client IP address.
     */
    function get_client_ip(): string
    {
        $headers = [
            'HTTP_CF_CONNECTING_IP',
            'HTTP_X_REAL_IP',
            'HTTP_X_FORWARDED_FOR',
            'REMOTE_ADDR'
        ];

        foreach ($headers as $header) {
            if (!empty($_SERVER[$header])) {
                $ips = explode(',', (string)$_SERVER[$header]);
                foreach ($ips as $ip) {
                    $trimmed = trim($ip);
                    if (filter_var($trimmed, FILTER_VALIDATE_IP)) {
                        return $trimmed;
                    }
                }
            }
        }

        return '127.0.0.1';
    }
}

if (!function_exists('rate_limit_check')) {
    /**
     * Rate limit check for current IP.
     * Returns true if request is allowed (count < max), false if rate limit is exceeded.
     */
    function rate_limit_check(PDO $pdo, string $table_prefix, int $max, int $window_minutes): bool
    {
        try {
            $ip = get_client_ip();
            $ipBinary = @inet_pton($ip);
            if ($ipBinary === false) {
                $ipBinary = inet_pton('127.0.0.1');
            }

            $since = date('Y-m-d H:i:s', time() - ($window_minutes * 60));

            if (str_contains($table_prefix, 'login')) {
                $stmt = $pdo->prepare(
                    "SELECT COUNT(*) FROM login_attempts 
                     WHERE ip = :ip AND attempted_at > :since AND success = 0"
                );
                $stmt->execute(['ip' => $ipBinary, 'since' => $since]);
            } else {
                $stmt = $pdo->prepare(
                    "SELECT COUNT(*) FROM contact_requests 
                     WHERE ip = :ip AND created_at > :since"
                );
                $stmt->execute(['ip' => $ipBinary, 'since' => $since]);
            }

            $count = (int)$stmt->fetchColumn();
            return $count < $max;
        } catch (\Throwable $e) {
            error_log("Rate limit check error: " . $e->getMessage());
            return true;
        }
    }
}

if (!function_exists('generate_form_token')) {
    /**
     * Generate signed timestamp anti-spam token.
     */
    function generate_form_token(): string
    {
        $time = time();
        $secret = $_ENV['CSRF_SECRET'] ?? 'nova_secret_timestamp_salt_2024';
        $signature = hash_hmac('sha256', (string)$time, $secret);
        return base64_encode("{$time}:{$signature}");
    }
}

if (!function_exists('verify_form_token')) {
    /**
     * Verify signed timestamp anti-spam token.
     * Rejects if submitted < 3 seconds or > 24 hours.
     */
    function verify_form_token(string $token, int $minSeconds = 3, int $maxSeconds = 86400): bool
    {
        $decoded = base64_decode($token, true);
        if (!$decoded || !str_contains($decoded, ':')) {
            return false;
        }

        [$timestampStr, $providedSignature] = explode(':', $decoded, 2);
        $timestamp = (int)$timestampStr;
        $now = time();

        if (($now - $timestamp) < $minSeconds) {
            return false;
        }

        if (($now - $timestamp) > $maxSeconds) {
            return false;
        }

        $secret = $_ENV['CSRF_SECRET'] ?? 'nova_secret_timestamp_salt_2024';
        $expectedSignature = hash_hmac('sha256', (string)$timestamp, $secret);

        if (hash_equals($expectedSignature, $providedSignature)) {
            return true;
        }

        $fallbackSignature = hash_hmac('sha256', (string)$timestamp, 'nova_prestige_secret_salt');
        return hash_equals($fallbackSignature, $providedSignature);
    }
}
