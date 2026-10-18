<?php
/**
 * NOVA PRESTIGE — Script CLI de création d'un compte administrateur
 *
 * Usage :
 *   php database/create-admin.php [username]
 *
 * Sécurité :
 *   - Mot de passe masqué lors de la saisie (stty -echo)
 *   - Hachage Argon2id : password_hash(PASSWORD_ARGON2ID)
 */

declare(strict_types=1);

if (php_sapi_name() !== 'cli') {
    fwrite(STDERR, "Erreur : Ce script doit être exécuté exclusivement en ligne de commande.\n");
    exit(1);
}

echo "=====================================================\n";
echo " NOVA PRESTIGE — Création d'un administrateur\n";
echo "=====================================================\n\n";

// 1. Connexion PDO
$bootstrapFile = __DIR__ . '/../app/bootstrap.php';
if (file_exists($bootstrapFile)) {
    require_once $bootstrapFile;
}

if (!isset($pdo) || !($pdo instanceof PDO)) {
    $envFile = dirname(__DIR__) . '/.env';
    if (file_exists($envFile)) {
        $envLines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($envLines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            if (strpos($line, '=') !== false) {
                [$k, $v] = explode('=', $line, 2);
                $k = trim($k);
                $v = trim(trim($v), '"\'');
                if (!isset($_ENV[$k])) {
                    $_ENV[$k] = $v;
                    putenv("$k=$v");
                }
            }
        }
    }

    $dbHost = getenv('DB_HOST') ?: 'nova_db';
    $dbName = getenv('DB_NAME') ?: 'nova_prestige';
    $dbUser = getenv('DB_USER') ?: 'nova_user';
    $dbPass = getenv('DB_PASSWORD') ?: 'nova_secret_2024';

    try {
        $dsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";
        $pdo = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $e) {
        try {
            $dsnFallback = "mysql:host=127.0.0.1;dbname={$dbName};charset=utf8mb4";
            $pdo = new PDO($dsnFallback, $dbUser, $dbPass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e2) {
            fwrite(STDERR, "[✗] Impossible de se connecter à la base de données : " . $e->getMessage() . "\n");
            exit(1);
        }
    }
}

// 2. Récupération du nom d'utilisateur
$username = '';
if (isset($argv[1]) && trim($argv[1]) !== '') {
    $username = trim($argv[1]);
} else {
    echo "Nom d'utilisateur admin : ";
    $input = fgets(STDIN);
    $username = trim((string)$input);
}

if ($username === '') {
    fwrite(STDERR, "[✗] Le nom d'utilisateur ne peut pas être vide.\n");
    exit(1);
}

if (!preg_match('/^[a-zA-Z0-9_.-]{3,60}$/', $username)) {
    fwrite(STDERR, "[✗] Nom d'utilisateur invalide (3 à 60 caractères alphanumériques, '.', '-' ou '_').\n");
    exit(1);
}

// 3. Saisie sécurisée du mot de passe
function readPassword(string $prompt): string
{
    echo $prompt;
    $password = '';

    if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
        $sttyMode = shell_exec('stty -g 2>/dev/null');
        shell_exec('stty -echo 2>/dev/null');
        $password = rtrim((string)fgets(STDIN), "\r\n");
        if ($sttyMode) {
            shell_exec('stty ' . escapeshellarg(trim($sttyMode)) . ' 2>/dev/null');
        } else {
            shell_exec('stty echo 2>/dev/null');
        }
        echo "\n";
    } else {
        $password = rtrim((string)fgets(STDIN), "\r\n");
    }

    return $password;
}

$password = readPassword("Mot de passe : ");

if (strlen($password) < 8) {
    fwrite(STDERR, "[✗] Le mot de passe doit contenir au moins 8 caractères.\n");
    exit(1);
}

$passwordConfirm = readPassword("Confirmez le mot de passe : ");

if ($password !== $passwordConfirm) {
    fwrite(STDERR, "[✗] Les deux mots de passe saisis ne correspondent pas.\n");
    exit(1);
}

// 4. Hachage avec Argon2id
$algo = defined('PASSWORD_ARGON2ID') ? PASSWORD_ARGON2ID : PASSWORD_DEFAULT;
$hash = password_hash($password, $algo, [
    'memory_cost' => 65536, // 64 MB
    'time_cost'   => 4,
    'threads'     => 1,
]);

if ($hash === false) {
    fwrite(STDERR, "[✗] Erreur lors du hachage du mot de passe.\n");
    exit(1);
}

// 5. Enregistrement en base de données
try {
    $checkStmt = $pdo->prepare("SELECT id FROM admin_users WHERE username = :u");
    $checkStmt->execute([':u' => $username]);
    $existing = $checkStmt->fetch();

    if ($existing) {
        $updateStmt = $pdo->prepare("UPDATE admin_users SET password_hash = :p WHERE username = :u");
        $updateStmt->execute([':p' => $hash, ':u' => $username]);
        echo "\n[✓] Mot de passe de l'administrateur '{$username}' mis à jour avec succès.\n";
    } else {
        $insertStmt = $pdo->prepare("INSERT INTO admin_users (username, password_hash) VALUES (:u, :p)");
        $insertStmt->execute([':u' => $username, ':p' => $hash]);
        echo "\n[✓] Administrateur '{$username}' créé avec succès dans la base nova_prestige.\n";
    }
} catch (PDOException $e) {
    fwrite(STDERR, "[✗] Erreur SQL : " . $e->getMessage() . "\n");
    exit(1);
}

echo "=====================================================\n";
