<?php
if (!isset($page_key)) {
    $page_key = 'home';
}
if (!isset($seo_data) && function_exists('seo')) {
    $seo_data = seo($page_key);
}
?>
<!DOCTYPE html>
<html lang="fr" class="" id="html-root">
<head>
  <meta charset="UTF-8">
  <!-- Anti-flash dark mode script FIRST -->
  <script>
    (function(){
      var t = localStorage.getItem('np-theme');
      var d = document.documentElement;
      if (t === 'dark' || (t === null && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        d.classList.add('dark');
      } else {
        d.classList.remove('dark');
      }
      d.classList.add('js');
    })();
  </script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Theme Color -->
  <meta name="theme-color" content="#12304F" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#0A0F16" media="(prefers-color-scheme: dark)">

  <!-- Robots (if noindex defined) -->
  <?php if (!empty($noindex)): ?>
  <meta name="robots" content="noindex, nofollow">
  <?php else: ?>
  <meta name="robots" content="index, follow">
  <?php endif; ?>

  <!-- Primary SEO -->
  <title><?= e($seo_data['title'] ?? 'NOVA PRESTIGE | Bureau d\'études techniques & conseil industriel') ?></title>
  <meta name="description" content="<?= e($seo_data['description'] ?? '') ?>">
  <link rel="canonical" href="<?= e($seo_data['canonical'] ?? url('/')) ?>">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="NOVA PRESTIGE">
  <meta property="og:title" content="<?= e($seo_data['title'] ?? 'NOVA PRESTIGE') ?>">
  <meta property="og:description" content="<?= e($seo_data['description'] ?? '') ?>">
  <meta property="og:url" content="<?= e($seo_data['canonical'] ?? url('/')) ?>">
  <meta property="og:image" content="<?= url('/assets/img/og-default.webp') ?>">
  <meta property="og:image:alt" content="NOVA PRESTIGE — Bureau d'études techniques, conseil industriel et formation">
  <meta property="og:locale" content="fr_FR">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($seo_data['title'] ?? 'NOVA PRESTIGE') ?>">
  <meta name="twitter:description" content="<?= e($seo_data['description'] ?? '') ?>">
  <meta name="twitter:image" content="<?= url('/assets/img/og-default.webp') ?>">

  <!-- Preload fonts -->
  <link rel="preload" href="/assets/fonts/SpaceGrotesk-SemiBold.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/Inter-Regular.woff2" as="font" type="font/woff2" crossorigin>

  <?php if ($page_key === 'home'): ?>
  <!-- Preload hero image if set -->
  <?php 
    $hero_img = function_exists('img') ? img('home.hero.image') : ['src' => '/assets/img/home-hero.webp'];
    if (!empty($hero_img['src']) && file_exists(dirname(__DIR__, 2) . '/public' . $hero_img['src'])): 
  ?>
  <link rel="preload" href="<?= e($hero_img['src']) ?>" as="image" fetchpriority="high">
  <?php endif; ?>
  <?php endif; ?>

  <!-- Favicons -->
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32.png">
  <link rel="icon" type="image/png" sizes="512x512" href="/assets/img/favicon-512.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon-180.png">

  <!-- CSS -->
  <link rel="stylesheet" href="/assets/css/app.css">
  <link rel="stylesheet" href="/assets/vendor/toastify/toastify.min.css">

  <!-- Structured Data JSON-LD -->
  <?php require __DIR__ . '/jsonld.php'; ?>
</head>
