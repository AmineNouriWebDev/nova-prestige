<?php
http_response_code(404);

$page_key = '404';
$noindex = true;
$seo_data = [
    'title' => "404 — Page introuvable | NOVA PRESTIGE",
    'description' => "La page demandée est introuvable ou a été déplacée.",
    'canonical' => url('/404')
];

include __DIR__ . '/../partials/head.php';
?>
<body class="bg-np-bg text-np-text font-inter antialiased selection:bg-np-accent selection:text-white" <?= function_exists('is_admin') && is_admin() ? 'data-admin="1"' : '' ?> id="top">

  <!-- Skip link -->
  <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 bg-np-accent text-white px-5 py-2.5 rounded-md shadow-xl z-50 font-medium">Aller au contenu principal</a>

  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main id="main-content" class="min-h-[75vh] flex items-center py-16 sm:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="max-w-2xl mx-auto text-center">
        
        <!-- Technical Error Label -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/30 text-xs font-mono text-np-accent mb-6">
          <span class="w-2 h-2 rounded-full bg-np-accent"></span>
          <span>Erreur 404 • Coordonnées non trouvées</span>
        </div>

        <!-- 404 Big Number in Space Grotesk / Mono -->
        <div class="font-grotesk font-extrabold text-7xl sm:text-9xl text-np-primary dark:text-np-accent tracking-tighter mb-4 select-none">
          404
        </div>

        <h1 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text mb-4 leading-tight">
          La page que vous recherchez n'existe pas ou a été déplacée.
        </h1>

        <p class="text-base text-np-text-muted leading-relaxed mb-10 max-w-lg mx-auto">
          Le document technique ou le lien demandé n'est pas accessible. Vous pouvez revenir à la page d'accueil ou consulter nos expertises industrielles ci-dessous.
        </p>

        <!-- Action Links -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
          <a href="/" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-lg bg-np-accent hover:bg-np-accent/90 text-white font-semibold text-sm transition-all shadow-md group">
            <span>Retour à l'accueil</span>
            <span class="ml-2 transition-transform group-hover:translate-x-1">→</span>
          </a>

          <a href="/contact" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-lg border border-np-border hover:border-np-accent text-sm font-medium text-np-text hover:text-np-accent bg-np-surface transition-all">
            Nous contacter
          </a>
        </div>

        <!-- Quick Links Grid -->
        <div class="pt-8 border-t border-np-border">
          <p class="text-xs font-mono text-np-text-muted uppercase tracking-wider mb-4">Accès rapide aux expertises :</p>
          <div class="flex flex-wrap justify-center gap-2 sm:gap-3 text-xs font-mono">
            <a href="/bureau-etudes-faisabilite" class="px-3 py-1.5 rounded-md bg-np-surface border border-np-border hover:border-np-accent hover:text-np-accent transition-colors">Faisabilité</a>
            <a href="/prototypes-developpement-produits" class="px-3 py-1.5 rounded-md bg-np-surface border border-np-border hover:border-np-accent hover:text-np-accent transition-colors">Prototypes</a>
            <a href="/facades-metalliques-bardage-calepinage" class="px-3 py-1.5 rounded-md bg-np-surface border border-np-border hover:border-np-accent hover:text-np-accent transition-colors">Façades & calepinage</a>
            <a href="/methodes-industrialisation" class="px-3 py-1.5 rounded-md bg-np-surface border border-np-border hover:border-np-accent hover:text-np-accent transition-colors">Méthodes</a>
            <a href="/formation-technique-atelier" class="px-3 py-1.5 rounded-md bg-np-surface border border-np-border hover:border-np-accent hover:text-np-accent transition-colors">Formation sur site</a>
          </div>
        </div>

      </div>

    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

  <!-- Scripts -->
  <script src="/assets/vendor/toastify/toastify.min.js" defer></script>
  <script src="/assets/js/main.js" type="module" defer></script>
</body>
</html>
