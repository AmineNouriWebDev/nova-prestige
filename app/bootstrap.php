<?php
declare(strict_types=1);

/**
 * NOVA PRESTIGE — Application Bootstrap
 */

// Define root directory
$rootDir = dirname(__DIR__, 1);

// Autoload composer dependencies
if (file_exists($rootDir . '/vendor/autoload.php')) {
    require_once $rootDir . '/vendor/autoload.php';
}

// Load .env configuration
if (class_exists(\Dotenv\Dotenv::class) && file_exists($rootDir . '/.env')) {
    $dotenv = \Dotenv\Dotenv::createImmutable($rootDir);
    $dotenv->safeLoad();
}

// Error handling based on environment
$isDebug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);
if ($isDebug) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    ini_set('log_errors', '1');
}

// Secure session configuration
if (session_status() === PHP_SESSION_NONE) {
    $sessionName = $_ENV['SESSION_NAME'] ?? 'nova_prestige_session';
    session_name($sessionName);

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443)
        || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

    ini_set('session.gc_maxlifetime', '7200');
    ini_set('session.use_strict_mode', '1');
    ini_set('session.cookie_httponly', '1');

    session_set_cookie_params([
        'lifetime' => 7200,
        'path' => '/',
        'domain' => '',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);

    session_start();
}

// Inactivity timeout (2 hours)
if (isset($_SESSION['admin_user_id'])) {
    if (isset($_SESSION['admin_last_active']) && (time() - (int)$_SESSION['admin_last_active'] > 7200)) {
        unset($_SESSION['admin_user_id'], $_SESSION['admin_username'], $_SESSION['admin_last_active']);
    } else {
        $_SESSION['admin_last_active'] = time();
    }
}

// Database connection (PDO)
$dbHost = $_ENV['DB_HOST'] ?? 'nova_db';
$dbPort = $_ENV['DB_PORT'] ?? '3306';
$dbName = $_ENV['DB_NAME'] ?? 'nova_prestige';
$dbUser = $_ENV['DB_USER'] ?? 'nova_user';
$dbPass = $_ENV['DB_PASSWORD'] ?? $_ENV['DB_PASS'] ?? 'nova_secret_2024';

$dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $pdoOptions);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    $pdo = null;
}

// Security headers
if (!headers_sent()) {
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data: blob:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Permissions-Policy: camera=(), microphone=(), geolocation=()");
}

// Load helpers
require_once __DIR__ . '/helpers.php';

// Load content defaults
$CONTENT_DEFAULTS = require $rootDir . '/content/defaults.php';

// Preload content cache for the requested page
$page_key = current_page_key();
if ($pdo instanceof PDO) {
    bootstrap_content_cache($pdo, $page_key);
}
