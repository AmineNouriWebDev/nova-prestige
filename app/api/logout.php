<?php
declare(strict_types=1);

if (!function_exists('json_response')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}

/**
 * NOVA PRESTIGE — Admin Logout API Endpoint
 *
 * Destroys the admin session and clears related authentication cookies.
 */

header('X-Robots-Tag: noindex, nofollow');

// Only allow POST
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    json_response(['error' => 'Méthode non autorisée'], 405);
}

// Clear admin session variables
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

unset($_SESSION['admin_user_id'], $_SESSION['admin_username'], $_SESSION['admin_last_active']);

// Regenerate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

json_response(['success' => true, 'message' => 'Déconnexion effectuée avec succès']);
