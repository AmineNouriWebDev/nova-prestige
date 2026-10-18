<?php
declare(strict_types=1);

$page_key = 'mentions';
$seo_data = function_exists('seo') ? seo('mentions') : [
    'title' => 'Mentions légales | NOVA PRESTIGE',
    'description' => 'Mentions légales et informations éditoriales du site NOVA PRESTIGE.',
    'canonical' => url('/mentions-legales')
];

include __DIR__ . '/../partials/head.php';
?>
<body class="bg-np-bg text-np-text font-inter antialiased selection:bg-np-accent selection:text-white" <?= function_exists('is_admin') && is_admin() ? 'data-admin="1"' : '' ?> id="top">

  <!-- Accessibility Skip link -->
  <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 bg-np-accent text-white px-5 py-2.5 rounded-md shadow-xl z-50 font-medium">Aller au contenu principal</a>

  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main id="main-content" class="pt-28 pb-20 sm:pb-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
      
      <div class="mb-10 text-center sm:text-left">
        <h1 class="font-grotesk text-3xl sm:text-4xl font-bold text-np-text tracking-tight mb-4" data-edit="seo.mentions.title" data-type="text">
          <?= e(t('seo.mentions.title')) ?>
        </h1>
        <p class="text-np-text-muted text-sm sm:text-base">
          Dernière mise à jour : 2024
        </p>
      </div>

      <div class="prose prose-slate dark:prose-invert max-w-none space-y-8 text-sm sm:text-base leading-relaxed">
        
        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3">1. Éditeur du site</h2>
          <p>
            Le site <strong>NOVA PRESTIGE</strong> est édité par :<br>
            <strong>NOVA PRESTIGE</strong> — Bureau d'études techniques, conseil industriel & formation<br>
            Responsable éditorial : M. Nouiri Ali, Consultant technique senior.<br>
            Contact : <a href="mailto:contact@novaprestige.fr" class="text-np-accent hover:underline">contact@novaprestige.fr</a>
          </p>
        </section>

        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3">2. Hébergement</h2>
          <p>
            Le site est hébergé sur une infrastructure VPS sécurisée :<br>
            Serveur dédié en Europe.<br>
            Protection anti-DDoS, certificat SSL/TLS Let's Encrypt.
          </p>
        </section>

        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3">3. Propriété intellectuelle & Illustrations IA</h2>
          <p>
            L'ensemble des éléments graphiques, de structure et de contenu textuel du site sont la propriété exclusive de NOVA PRESTIGE.<br>
            <strong>Mention obligatoire :</strong> Les images et photographies éditoriales illustrant les réalisations industrielles sont des <em>illustrations générées par intelligence artificielle</em> à des fins de représentation conceptuelle de savoir-faire technique. Elles ne constituent en aucun cas des photographies d'ateliers ou de machines détenus en propre par NOVA PRESTIGE.
          </p>
        </section>

        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3">4. Limitation de responsabilité</h2>
          <p>
            NOVA PRESTIGE intervient exclusivement comme prestataire en ingénierie de conseil, études techniques et formation. La fabrication physique des pièces, prototypes ou ouvrages finaux est réalisée sous la responsabilité des ateliers clients ou de leurs partenaires industriels fabricants.
          </p>
        </section>

      </div>

    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
