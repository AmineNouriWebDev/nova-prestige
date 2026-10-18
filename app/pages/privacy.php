<?php
declare(strict_types=1);

$page_key = 'privacy';
$seo_data = function_exists('seo') ? seo('privacy') : [
    'title' => 'Politique de confidentialité | NOVA PRESTIGE',
    'description' => 'Politique de confidentialité et traitement des données personnelles de NOVA PRESTIGE.',
    'canonical' => url('/politique-confidentialite')
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
        <h1 class="font-grotesk text-3xl sm:text-4xl font-bold text-np-text tracking-tight mb-4" data-edit="seo.privacy.title" data-type="text">
          <?= e(t('seo.privacy.title')) ?>
        </h1>
        <p class="text-np-text-muted text-sm sm:text-base">
          Conformité au Règlement Général sur la Protection des Données (RGPD)
        </p>
      </div>

      <div class="prose prose-slate dark:prose-invert max-w-none space-y-8 text-sm sm:text-base leading-relaxed">
        
        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3">1. Collecte et finalité des données</h2>
          <p>
            Les informations recueillies via les formulaires de contact et de devis (nom, entreprise, adresse e-mail, téléphone, pays, description de projet) sont enregistrées dans un fichier informatisé par <strong>NOVA PRESTIGE</strong>.
          </p>
          <p class="mt-2">
            Elles sont destinées exclusivement à :
          </p>
          <ul class="list-disc pl-5 mt-2 space-y-1">
            <li>L'étude de faisabilité technique et la préparation de devis.</li>
            <li>La prise de contact direct avec le porteur de projet ou le responsable d'atelier.</li>
            <li>Le suivi relationnel de la mission d'ingénierie ou de formation.</li>
          </ul>
        </section>

        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3">2. Durée de conservation</h2>
          <p>
            Les données relatives aux demandes de devis et contacts sont conservées pendant une durée maximale de 3 ans à compter du dernier contact émanant du prospect, puis sont définitivement supprimées.
          </p>
        </section>

        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3">3. Destinataires et transfert</h2>
          <p>
            Aucune donnée collectée sur ce site n'est transmise, cédée, louée ou vendue à des tiers ou à des organismes commerciaux. Aucun traceur publicitaire tiers (Google Analytics, régies publicitaires, Facebook Pixel) n'est actif sur le site.
          </p>
        </section>

        <section class="bg-np-surface border border-np-border rounded-xl p-6 sm:p-8">
          <h2 class="text-lg sm:text-xl font-bold text-np-text font-grotesk mb-3">4. Vos droits d'accès et de rectification</h2>
          <p>
            Conformément à la réglementation applicable, vous pouvez exercer votre droit d'accès, de rectification, d'effacement de vos données ou de limitation du traitement en adressant un e-mail à :<br>
            <a href="mailto:contact@novaprestige.fr" class="text-np-accent hover:underline font-semibold">contact@novaprestige.fr</a>
          </p>
        </section>

      </div>

    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
