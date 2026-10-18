<?php
/**
 * NOVA PRESTIGE — Script de peuplement de la base de données (Database Seeder)
 *
 * Usage : php database/seed.php
 *
 * Ce script est idempotent : il n'écrase jamais les modifications effectuées
 * par l'utilisateur ou l'administrateur. Il n'insère que les clés manquantes.
 */

declare(strict_types=1);

echo "=====================================================\n";
echo " NOVA PRESTIGE — Initialisation de la base de données\n";
echo "=====================================================\n\n";

// 1. Chargement de l'environnement ou de app/bootstrap.php
$bootstrapFile = __DIR__ . '/../app/bootstrap.php';
if (file_exists($bootstrapFile)) {
    require_once $bootstrapFile;
    echo "[✓] app/bootstrap.php chargé avec succès.\n";
}

// 2. Initialisation ou validation de l'instance PDO
if (!isset($pdo) || !($pdo instanceof PDO)) {
    // Si bootstrap n'a pas initialisé $pdo, tentative de connexion directe via .env
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
        echo "[✓] Connexion PDO établie vers {$dbHost}/{$dbName}.\n";
    } catch (PDOException $e) {
        // En local ou host direct (ex: 127.0.0.1) si nova_db n'est pas résolu hors conteneur
        try {
            $dsnFallback = "mysql:host=127.0.0.1;dbname={$dbName};charset=utf8mb4";
            $pdo = new PDO($dsnFallback, $dbUser, $dbPass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
            echo "[✓] Connexion PDO établie vers 127.0.0.1/{$dbName}.\n";
        } catch (PDOException $e2) {
            fwrite(STDERR, "[✗] Erreur de connexion à la base de données : " . $e->getMessage() . "\n");
            exit(1);
        }
    }
}

// 3. Chargement des contenus par défaut
$defaultsFile = __DIR__ . '/../content/defaults.php';
$CONTENT_DEFAULTS = [];

if (file_exists($defaultsFile)) {
    $CONTENT_DEFAULTS = require $defaultsFile;
    echo "[✓] content/defaults.php chargé (" . count($CONTENT_DEFAULTS) . " éléments définis).\n";
} else {
    fwrite(STDERR, "[!] Avertissement : content/defaults.php introuvable.\n");
}

// 4. Insertion des contenus (idempotent : insertion uniquement si inexistant)
echo "\n--- Peuplement de la table `contents` ---\n";

$checkContentStmt = $pdo->prepare(
    "SELECT COUNT(*) FROM contents WHERE page_key = :page_key AND field_key = :field_key AND lang = :lang"
);

$insertContentStmt = $pdo->prepare(
    "INSERT INTO contents (page_key, field_key, lang, type, value, alt)
     VALUES (:page_key, :field_key, :lang, :type, :value, :alt)"
);

$contentInserted = 0;
$contentSkipped = 0;

foreach ($CONTENT_DEFAULTS as $key => $item) {
    $pageKey  = $item['page_key']  ?? 'home';
    $fieldKey = $item['field_key'] ?? $key;
    $lang     = $item['lang']      ?? 'fr';
    $type     = $item['type']      ?? 'text';
    $value    = $item['value']     ?? '';
    $alt      = $item['alt']       ?? null;

    $checkContentStmt->execute([
        ':page_key'  => $pageKey,
        ':field_key' => $fieldKey,
        ':lang'      => $lang,
    ]);

    if ((int)$checkContentStmt->fetchColumn() === 0) {
        $insertContentStmt->execute([
            ':page_key'  => $pageKey,
            ':field_key' => $fieldKey,
            ':lang'      => $lang,
            ':type'      => $type,
            ':value'     => $value,
            ':alt'       => $alt,
        ]);
        echo " [+] Inséré : {$pageKey}.{$fieldKey} [{$lang}]\n";
        $contentInserted++;
    } else {
        $contentSkipped++;
    }
}

echo " => Contents : {$contentInserted} inséré(s), {$contentSkipped} déjà existant(s).\n";

// 5. Insertion des paramètres globaux (table `settings`)
echo "\n--- Peuplement de la table `settings` ---\n";

$defaultSettings = [
    'site_name'       => 'NOVA PRESTIGE',
    'contact_email'   => 'à compléter',
    'phone'           => '',
    'whatsapp'        => '',
    'city'            => '',
    'linkedin'        => '',
    'mail_from_name'  => 'NOVA PRESTIGE',
    'mail_from_email' => '',
    'siret'           => '',
    'hebergeur'       => '',
    'session_name'    => 'np_session',
];

$checkSettingStmt = $pdo->prepare("SELECT COUNT(*) FROM settings WHERE k = :k");
$insertSettingStmt = $pdo->prepare("INSERT INTO settings (k, v) VALUES (:k, :v)");

$settingsInserted = 0;
$settingsSkipped = 0;

foreach ($defaultSettings as $k => $v) {
    $checkSettingStmt->execute([':k' => $k]);
    if ((int)$checkSettingStmt->fetchColumn() === 0) {
        $insertSettingStmt->execute([':k' => $k, ':v' => $v]);
        echo " [+] Inséré paramètre : {$k} = '{$v}'\n";
        $settingsInserted++;
    } else {
        $settingsSkipped++;
    }
}

echo " => Settings : {$settingsInserted} inséré(s), {$settingsSkipped} déjà existant(s).\n";

echo "\n=====================================================\n";
echo " [✓] Initialisation et seed terminés avec succès !\n";
echo "=====================================================\n";
