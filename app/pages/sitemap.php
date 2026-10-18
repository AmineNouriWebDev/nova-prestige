<?php
declare(strict_types=1);

/**
 * Dynamic XML Sitemap Generator
 * Excludes phase 2 placeholder pages (which carry noindex)
 */

header('Content-Type: application/xml; charset=UTF-8');

$baseUrl = rtrim($_ENV['APP_URL'] ?? '', '/');
if ($baseUrl === '') {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443) ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $baseUrl = "{$scheme}://{$host}";
}

$pages = [
    [
        'loc' => $baseUrl . '/',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    [
        'loc' => $baseUrl . '/contact',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => '0.8'
    ],
    [
        'loc' => $baseUrl . '/mentions-legales',
        'lastmod' => '2024-01-01',
        'changefreq' => 'yearly',
        'priority' => '0.3'
    ],
    [
        'loc' => $baseUrl . '/politique-confidentialite',
        'lastmod' => '2024-01-01',
        'changefreq' => 'yearly',
        'priority' => '0.3'
    ],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $p): ?>
  <url>
    <loc><?= htmlspecialchars($p['loc'], ENT_XML1, 'UTF-8') ?></loc>
    <lastmod><?= htmlspecialchars($p['lastmod'], ENT_XML1, 'UTF-8') ?></lastmod>
    <changefreq><?= htmlspecialchars($p['changefreq'], ENT_XML1, 'UTF-8') ?></changefreq>
    <priority><?= htmlspecialchars($p['priority'], ENT_XML1, 'UTF-8') ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
