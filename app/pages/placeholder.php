<?php
declare(strict_types=1);

$noindex = true;
$page_key = 'placeholder';
$title = $page_title ?? t('placeholder.title');

$seo_data = [
    'title' => $title . ' | NOVA PRESTIGE',
    'description' => t('placeholder.text'),
    'canonical' => url($_SERVER['REQUEST_URI'] ?? '/'),
];

include __DIR__ . '/../partials/head.php';
?>
<body class="bg-np-bg text-np-text font-inter antialiased selection:bg-np-accent selection:text-white" <?= function_exists('is_admin') && is_admin() ? 'data-admin="1"' : '' ?> id="top">

  <!-- Accessibility Skip link -->
  <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 bg-np-accent text-white px-5 py-2.5 rounded-md shadow-xl z-50 font-medium">Aller au contenu principal</a>

  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main id="main-content" class="min-h-[70vh] flex items-center justify-center pt-28 pb-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl text-center">
      
      <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-6">
        <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
        <span>Phase 2 — En cours de finalisation</span>
      </div>

      <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-6">
        <?= e($title) ?>
      </h1>

      <p class="text-np-text-muted text-base sm:text-lg leading-relaxed mb-10 max-w-xl mx-auto">
        <?= e(t('placeholder.text')) ?>
      </p>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="/contact?type=devis" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 active:scale-[0.98] rounded-xl shadow-lg transition-all duration-150">
          <span><?= e(t('placeholder.cta')) ?></span>
          <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
          </svg>
        </a>

        <a href="/" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-medium text-np-text hover:text-np-accent transition-colors">
          <span>← Retour à l'accueil</span>
        </a>
      </div>

    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
