<?php
declare(strict_types=1);

/**
 * Dynamic XML Sitemap Generator
 * Includes public, indexable pages and excludes phase 2 placeholders.
 */

header('Content-Type: application/xml; charset=UTF-8');

$pages = [
    '/',
    '/bureau-etudes-faisabilite',
    '/prototypes-developpement-produits',
    '/facades-metalliques-bardage-calepinage',
    '/methodes-industrialisation',
    '/conseil-industriel-equipements',
    '/formation-technique-atelier',
    '/france-tunisie-maghreb',
    '/a-propos',
    '/contact',
    '/mentions-legales',
    '/politique-confidentialite',
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $path): ?>
  <url>
    <loc><?= htmlspecialchars(url($path), ENT_XML1, 'UTF-8') ?></loc>
  </url>
<?php endforeach; ?>
</urlset>
