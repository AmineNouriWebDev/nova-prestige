<?php
declare(strict_types=1);

/**
 * NOVA PRESTIGE — Custom Lightweight Router
 */

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($requestUri, PHP_URL_PATH) ?: '/';
if ($path !== '/') {
    $path = rtrim($path, '/');
}

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
if ($method === 'HEAD') {
    $method = 'GET';
}

// Phase 2 slugs definition and title mapping
$phase2Slugs = [
    '/bureau-etudes-faisabilite' => 'Bureau d\'études & faisabilité',
    '/prototypes-developpement-produits' => 'Prototypes & développement de produits',
    '/facades-metalliques-bardage-calepinage' => 'Façades métalliques, bardage & calepinage',
    '/methodes-industrialisation' => 'Méthodes & industrialisation',
    '/conseil-industriel-equipements' => 'Conseil industriel & équipements',
    '/formation-technique-atelier' => 'Formation technique sur site',
    '/france-tunisie-maghreb' => 'France, Tunisie & Maghreb',
    '/a-propos' => 'À propos de NOVA PRESTIGE',
];

// Direct route table
$routes = [
    'GET' => [
        '/' => __DIR__ . '/pages/home.php',
        '/bureau-etudes-faisabilite' => __DIR__ . '/pages/service-bureau-etudes.php',
        '/prototypes-developpement-produits' => __DIR__ . '/pages/service-prototypes.php',
        '/facades-metalliques-bardage-calepinage' => __DIR__ . '/pages/service-facades.php',
        '/methodes-industrialisation' => __DIR__ . '/pages/service-methodes.php',
        '/conseil-industriel-equipements' => __DIR__ . '/pages/service-conseil.php',
        '/formation-technique-atelier' => __DIR__ . '/pages/service-formation.php',
        '/france-tunisie-maghreb' => __DIR__ . '/pages/zones.php',
        '/a-propos' => __DIR__ . '/pages/a-propos.php',
        '/contact' => __DIR__ . '/pages/contact.php',
        '/mentions-legales' => __DIR__ . '/pages/legal.php',
        '/politique-confidentialite' => __DIR__ . '/pages/privacy.php',
        '/sitemap.xml' => __DIR__ . '/pages/sitemap.php',
        '/robots.txt' => __DIR__ . '/pages/robots.php',
    ],
    'POST' => [
        '/api/login' => __DIR__ . '/api/login.php',
        '/api/logout' => __DIR__ . '/api/logout.php',
        '/api/content-save' => __DIR__ . '/api/content-save.php',
        '/api/image-upload' => __DIR__ . '/api/image-upload.php',
        '/api/contact-submit' => __DIR__ . '/api/contact-submit.php',
    ],
];

// 1. Check exact route match
if (isset($routes[$method][$path])) {
    $targetFile = $routes[$method][$path];
    if (file_exists($targetFile)) {
        require $targetFile;
        exit;
    }
}

// 2. Check Phase 2 slugs (GET only)
if ($method === 'GET' && array_key_exists($path, $phase2Slugs)) {
    $page_title = $phase2Slugs[$path];
    $placeholderFile = __DIR__ . '/pages/placeholder.php';
    if (file_exists($placeholderFile)) {
        require $placeholderFile;
        exit;
    }
    
    // Fallback if placeholder.php is not yet created
    header('X-Robots-Tag: noindex, nofollow');
    echo "<!DOCTYPE html><html lang='fr'><head><title>" . e($page_title) . " | NOVA PRESTIGE</title><meta name='robots' content='noindex'></head><body><h1>" . e($page_title) . "</h1><p>" . e(t('placeholder.text')) . "</p><p><a href='/contact'>" . e(t('placeholder.cta')) . "</a></p></body></html>";
    exit;
}

// 3. Fallback: 404 Not Found
http_response_code(404);
$notFoundFile = __DIR__ . '/pages/404.php';
if (file_exists($notFoundFile)) {
    require $notFoundFile;
    exit;
}

// Minimal fallback 404
echo "<!DOCTYPE html><html lang='fr'><head><title>404 — Page non trouvée | NOVA PRESTIGE</title></head><body><h1>404 — Page non trouvée</h1><p>La page demandée n'existe pas ou a été déplacée.</p><p><a href='/'>Retour à l'accueil</a></p></body></html>";
exit;
