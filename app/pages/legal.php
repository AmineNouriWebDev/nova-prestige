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
<body class="bg-np-bg text-np-text font-inter antialiased selection:bg-np-accent selection:text-white" <?= function_exists('is_admin') && is_admin() ? 'data-admin="1"' : '' ?> data-page="mentions" id="top">

  <!-- Accessibility Skip link -->
  <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 bg-np-accent text-white px-5 py-2.5 rounded-md shadow-xl z-50 font-medium">Aller au contenu principal</a>

  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main id="main-content" class="pt-28 pb-20 sm:pb-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
      
      <div class="mb-10 text-center sm:text-left">
        <h1 class="font-grotesk text-3xl sm:text-4xl font-bold text-np-text tracking-tight mb-4" data-edit="seo.mentions.title" data-type="text">
          <?= e(t('seo.mentions.title', 'Mentions légales | NOVA PRESTIGE')) ?>
        </h1>
        <p class="text-np-text-muted text-sm sm:text-base" data-edit="mentions.last_updated" data-type="text">
          <?= e(t('mentions.last_updated', 'Dernière mise à jour : novembre 2026')) ?>
        </p>
      </div>

      <div class="prose prose-slate dark:prose-invert max-w-none space-y-8 text-sm sm:text-base leading-relaxed">
        
        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3" data-edit="mentions.section1.title" data-type="text"><?= e(t('mentions.section1.title', '1. Éditeur du site')) ?></h2>
          <p data-edit="mentions.section1.body" data-type="richtext"><?= t('mentions.section1.body', 'Le site <strong>NOVA PRESTIGE</strong> est édité par :<br><strong>NOVA PRESTIGE</strong> — Bureau d’études techniques, conseil industriel &amp; formation<br>Responsable éditorial : M. Nouiri Ali, Consultant technique senior.<br>Contact : <a href="mailto:contact@novaprestige.fr">contact@novaprestige.fr</a>') ?></p>
        </section>

        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3" data-edit="mentions.section2.title" data-type="text"><?= e(t('mentions.section2.title', '2. Développement, maintenance et hébergement')) ?></h2>
          <p data-edit="mentions.section2.body" data-type="richtext"><?= t('mentions.section2.body', 'Le site est conçu, développé et maintenu techniquement par la société <strong>MaxSolving</strong> (<a href="https://maxsolving.com">maxsolving.com</a>), qui assure également sa gestion technique et son hébergement sur une infrastructure VPS située en Europe.<br>Les serveurs sont protégés par un certificat SSL/TLS Let’s Encrypt et des mesures de protection réseau.') ?></p>
        </section>

        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3" data-edit="mentions.section3.title" data-type="text"><?= e(t('mentions.section3.title', '3. Propriété intellectuelle & Illustrations IA')) ?></h2>
          <p data-edit="mentions.section3.body" data-type="richtext"><?= t('mentions.section3.body', 'L’ensemble des éléments graphiques, de structure et de contenu textuel du site sont la propriété exclusive de NOVA PRESTIGE.<br><strong>Mention obligatoire :</strong> Les images et photographies éditoriales illustrant les réalisations industrielles sont des <em>illustrations générées par intelligence artificielle</em> à des fins de représentation conceptuelle de savoir-faire technique. Elles ne constituent en aucun cas des photographies d’ateliers ou de machines détenus en propre par NOVA PRESTIGE.') ?></p>
        </section>

        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3" data-edit="mentions.section4.title" data-type="text"><?= e(t('mentions.section4.title', '4. Limitation de responsabilité')) ?></h2>
          <p data-edit="mentions.section4.body" data-type="richtext"><?= t('mentions.section4.body', 'NOVA PRESTIGE intervient exclusivement comme prestataire en ingénierie de conseil, études techniques et formation. La fabrication physique des pièces, prototypes ou ouvrages finaux est réalisée sous la responsabilité des ateliers clients ou de leurs partenaires industriels fabricants.') ?></p>
        </section>

      </div>

    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
