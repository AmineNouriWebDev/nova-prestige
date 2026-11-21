<?php
declare(strict_types=1);

if (!function_exists('json_response')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}

header('X-Robots-Tag: noindex, nofollow');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    json_response(['error' => 'Méthode non autorisée'], 405);
}
if (!is_admin()) {
    json_response(['error' => 'Authentification requise'], 401);
}
if (!csrf_verify()) {
    json_response(['error' => 'Jeton CSRF invalide ou expiré'], 403);
}

global $pdo;
if (!$pdo instanceof PDO) {
    json_response(['error' => 'Erreur de connexion à la base de données'], 500);
}

$requestId = filter_var($_POST['request_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($requestId === false || $requestId === null) {
    json_response(['error' => 'Demande introuvable'], 422);
}

try {
    ensure_contact_request_reads_table($pdo);
    $stmt = $pdo->prepare(
        "INSERT INTO contact_request_reads (contact_request_id, admin_user_id, read_at)
         SELECT id, :admin_user_id, NOW()
         FROM contact_requests
         WHERE id = :request_id
         ON DUPLICATE KEY UPDATE admin_user_id = VALUES(admin_user_id), read_at = VALUES(read_at)"
    );
    $adminUserId = isset($_SESSION['admin_user_id']) ? (int)$_SESSION['admin_user_id'] : null;
    $stmt->execute(['admin_user_id' => $adminUserId, 'request_id' => $requestId]);

    $check = $pdo->prepare('SELECT 1 FROM contact_request_reads WHERE contact_request_id = :request_id');
    $check->execute(['request_id' => $requestId]);
    if (!$check->fetchColumn()) {
        json_response(['error' => 'Demande introuvable'], 404);
    }

    json_response([
        'success' => true,
        'unread_count' => contact_request_unread_count($pdo),
    ]);
} catch (Throwable $e) {
    error_log('Unable to mark contact request as read: ' . $e->getMessage());
    json_response(['error' => 'La demande n’a pas pu être mise à jour.'], 500);
}
