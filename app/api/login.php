<?php
declare(strict_types=1);

if (!function_exists('json_response')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}

/**
 * NOVA PRESTIGE — Admin Login API Endpoint
 *
 * Validates credentials against admin_users, applies IP rate-limiting,
 * verifies CSRF token, and creates a secure authenticated session.
 */

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

// 1. IP Rate Limiting: max 5 failed attempts per 15 minutes per IP
if (!rate_limit_check($pdo, 'login_attempts', 5, 15)) {
    json_response(['error' => 'Trop de tentatives échouées. Réessayez dans 15 minutes.'], 429);
}

// 2. CSRF Verification
if (!csrf_verify()) {
    json_response(['error' => 'Jeton CSRF invalide ou expiré'], 403);
}

// 3. Parse input credentials (supports JSON or form-data)
$rawBody = file_get_contents('php://input');
$data = json_decode($rawBody, true);
if (!is_array($data)) {
    $data = $_POST;
}

$username = trim((string)($data['username'] ?? ''));
$password = (string)($data['password'] ?? '');

if ($username === '' || $password === '') {
    json_response(['error' => 'Identifiants invalides'], 400);
}

$clientIp = get_client_ip();
$ipBinary = @inet_pton($clientIp);
if ($ipBinary === false) {
    $ipBinary = inet_pton('127.0.0.1');
}

// 4. Query user from database
try {
    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM admin_users WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 5. Verify password
    if ($user && password_verify($password, (string)$user['password_hash'])) {
        // Check if password needs rehash (e.g. options changed)
        if (password_needs_rehash((string)$user['password_hash'], PASSWORD_ARGON2ID)) {
            $newHash = password_hash($password, PASSWORD_ARGON2ID);
            $rehashStmt = $pdo->prepare("UPDATE admin_users SET password_hash = :hash WHERE id = :id");
            $rehashStmt->execute(['hash' => $newHash, 'id' => $user['id']]);
        }

        // Regenerate session ID for security
        session_regenerate_id(true);

        // Store session variables
        $_SESSION['admin_user_id'] = (int)$user['id'];
        $_SESSION['admin_username'] = (string)$user['username'];
        $_SESSION['admin_last_active'] = time();

        // Regenerate CSRF token on login
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Log successful attempt
        $logStmt = $pdo->prepare("INSERT INTO login_attempts (ip, attempted_at, success) VALUES (:ip, NOW(), 1)");
        $logStmt->execute(['ip' => $ipBinary]);

        json_response([
            'success' => true,
            'message' => 'Connexion réussie',
            'csrf_token' => $_SESSION['csrf_token'],
            'username' => $user['username']
        ]);
    } else {
        // Log failed attempt
        $logStmt = $pdo->prepare("INSERT INTO login_attempts (ip, attempted_at, success) VALUES (:ip, NOW(), 0)");
        $logStmt->execute(['ip' => $ipBinary]);

        json_response(['error' => 'Identifiants invalides'], 401);
    }
} catch (\Throwable $e) {
    error_log("Login error: " . $e->getMessage());
    json_response(['error' => 'Une erreur interne est survenue.'], 500);
}
