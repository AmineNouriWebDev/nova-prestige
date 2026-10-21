<?php
declare(strict_types=1);

$page_key = 'a-propos';
$seo_data = function_exists('seo') ? seo('a-propos') : [
    'title' => 'À propos de NOVA PRESTIGE | 40 ans d\'expertise tôlerie et façades',
    'description' => 'Découvrez le parcours, les valeurs et les engagements de NOVA PRESTIGE. 40+ ans de pratique terrain en tôlerie industrielle, pliage et enveloppe du bâtiment.',
    'canonical' => url('/a-propos')
];

include __DIR__ . '/../partials/head.php';
?>
<body class="bg-np-bg text-np-text font-inter antialiased selection:bg-np-accent selection:text-white" <?= function_exists('is_admin') && is_admin() ? 'data-admin="1"' : '' ?> data-page="<?= e($page_key) ?>" id="top">

  <!-- Accessibility Skip link -->
  <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 bg-np-accent text-white px-5 py-2.5 rounded-md shadow-xl z-50 font-medium">Aller au contenu principal</a>

  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main id="main-content" class="pt-24 lg:pt-28">

    <!-- ========================================== -->
    <!-- HERO SECTION                               -->
    <!-- ========================================== -->
    <section class="relative py-16 lg:py-24 overflow-hidden border-b border-np-border">
      <div class="absolute inset-0 bg-radial-at-t from-np-primary/20 via-transparent to-transparent pointer-events-none"></div>

      <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-mono text-np-text-muted mb-6" aria-label="Fil d'Ariane">
          <a href="/" class="hover:text-np-accent transition-colors">Accueil</a>
          <span>/</span>
          <span class="text-np-accent font-semibold">À propos</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Text Column -->
          <div class="lg:col-span-7">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-5">
              <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
              <span data-edit="about.hero.badge" data-type="text"><?= e(t('about.hero.badge', 'Parcours & Engagements — Conseil Senior')) ?></span>
            </div>

            <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-6 leading-tight" data-edit="about.hero.title" data-type="text">
              <?= e(t('about.hero.title', 'À propos de NOVA PRESTIGE : 40 ans de culture tôlerie, pliage et façades')) ?>
            </h1>

            <p class="text-base sm:text-lg text-np-text-muted leading-relaxed mb-8" data-edit="about.hero.subtitle" data-type="richtext">
              <?= t('about.hero.subtitle', 'Du compagnonnage d\'atelier aux missions de conseil senior pour les directions industrielles. Découvrez l\'ADN technique de NOVA PRESTIGE : <strong>une expertise forgée au contact direct du métal, des machines et des chantiers</strong>.') ?>
            </p>

            <div class="flex flex-wrap items-center gap-4 mb-10">
              <a href="/contact" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-lg hover:shadow transition-all duration-200">
                <span data-edit="about.hero.cta_quote" data-type="text"><?= e(t('about.hero.cta_quote', 'Échanger avec notre fondateur')) ?></span>
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>

              <a href="#valeurs" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-medium text-np-text hover:text-np-accent border border-np-border hover:border-np-accent rounded-xl transition-colors">
                <span>Nos engagements piliers ↓</span>
              </a>
            </div>

            <!-- Key Proof Points -->
            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-np-border/60">
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-accent" data-edit="about.stat.val1" data-type="text"><?= e(t('about.stat.val1', '40+ ans')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="about.stat.lbl1" data-type="text"><?= e(t('about.stat.lbl1', 'Savoir-faire atelier')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="about.stat.val2" data-type="text"><?= e(t('about.stat.val2', '0 compromis')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="about.stat.lbl2" data-type="text"><?= e(t('about.stat.lbl2', 'Sur la faisabilité')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="about.stat.val3" data-type="text"><?= e(t('about.stat.val3', '100% Neutre')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="about.stat.lbl3" data-type="text"><?= e(t('about.stat.lbl3', 'Conseil indépendant')) ?></span>
              </div>
            </div>

          </div>

          <!-- Hero Media Column -->
          <div class="lg:col-span-5">
            <?php 
              $hero_img = function_exists('img') ? img('about.hero.image', '/assets/img/image7-2.webp', 'Atelier et équipements techniques NOVA PRESTIGE') : ['src' => '/assets/img/image7-2.webp', 'alt' => 'À propos de NOVA PRESTIGE']; 
            ?>
            <div class="rounded-2xl overflow-hidden border border-np-border bg-np-surface shadow-2xl relative group">
              <div class="aspect-[4/3] w-full relative overflow-hidden bg-slate-900">
                <img src="<?= e($hero_img['src']) ?>" 
                     alt="<?= e($hero_img['alt']) ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" 
                     loading="eager"
                     decoding="async"
                     data-edit="about.hero.image" 
                     data-type="image">
                <div class="absolute inset-0 bg-gradient-to-t from-np-surface via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Emblem Top-Left -->
                <div class="absolute top-4 left-4 w-11 h-11 rounded-xl bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-np-accent shadow-xl z-10 pointer-events-none">
                  <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                  </svg>
                </div>
              </div>

              <div class="p-6 border-t border-np-border/60">
                <div class="flex items-center justify-between text-xs font-mono text-np-text-muted">
                  <span>VOCATION :</span>
                  <span class="text-np-accent font-semibold">Passerelle Bureau d'études & Atelier</span>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 2: NOTRE HISTOIRE & PHILOSOPHIE    -->
    <!-- ========================================== -->
    <section class="py-20 bg-np-surface/40 border-b border-np-border">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
        
        <div class="max-w-3xl mx-auto text-center mb-16">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="about.story.tag" data-type="text">
            <?= e(t('about.story.tag', 'L\'HISTOIRE & LA VISION')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-6" data-edit="about.story.title" data-type="text">
            <?= e(t('about.story.title', 'Le métal ne ment pas : la vérité du terrain avant tout')) ?>
          </h2>
        </div>

        <div class="space-y-6 text-np-text-muted text-base leading-relaxed max-w-3xl mx-auto">
          <p data-edit="about.story.p1" data-type="richtext">
            <?= t('about.story.p1', 'Fondée sur plus de quatre décennies d\'exercice passionné dans l\'industrie métallurgique, <strong>NOVA PRESTIGE</strong> est née d\'un constat simple mais récurrent : <em>le fossé grandissant entre la conception numérique et la réalité physique des ateliers</em>.') ?>
          </p>
          <p data-edit="about.story.p2" data-type="richtext">
            <?= t('about.story.p2', 'Trop souvent, des pièces modélisées avec brio sur les logiciels de CAO 3D s\'avèrent impossibles à plier, déforment les tôles au-delà des tolérances acceptables ou imposent des temps de réglage machine exorbitants. À l\'inverse, les opérateurs d\'atelier gaspillent une énergie précieuse à compenser empiriquement des plans incomplets.') ?>
          </p>
          <p data-edit="about.story.p3" data-type="richtext">
            <?= t('about.story.p3', 'NOVA PRESTIGE se positionne comme le <strong>maillon fort et pragmatique</strong> entre les architectes, les bureaux d\'études et les équipes de production. Nous apportons une culture éprouvée du copeau, de la bavette, du vé de pliage et des contraintes réelles de fabrication pour que chaque projet voit le jour dans les délais et au juste coût.') ?>
          </p>
        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 3: NOS 3 ENGAGEMENTS PILIERS       -->
    <!-- ========================================== -->
    <section id="valeurs" class="py-20 lg:py-28">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="about.values.tag" data-type="text">
            <?= e(t('about.values.tag', 'NOS ENGAGEMENTS FONDAMENTAUX')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="about.values.title" data-type="text">
            <?= e(t('about.values.title', 'Trois principes non négociables qui guident chacune de nos missions')) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold text-lg mb-6">
              01
            </div>
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-3" data-edit="about.val1.t" data-type="text">
              <?= e(t('about.val1.t', 'Pragmatisme d\'atelier')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="about.val1.d" data-type="text">
              <?= e(t('about.val1.d', 'Chaque trait de dessin, chaque tolérance et chaque séquence est pensée pour les mains de l\'opérateur et les capacités précises de vos presses plieuses. Aucun livrable théorique inutilisable.')) ?>
            </p>
          </div>

          <div class="p-8 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold text-lg mb-6">
              02
            </div>
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-3" data-edit="about.val2.t" data-type="text">
              <?= e(t('about.val2.t', 'Confidentialité absolue')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="about.val2.d" data-type="text">
              <?= e(t('about.val2.d', 'Vos plans, vos prototypes et vos méthodes de fabrication constituent votre capital concurrentiel le plus précieux. Nous appliquons une politique stricte de secret professionnel avec signature d\'accord NDA.')) ?>
            </p>
          </div>

          <div class="p-8 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold text-lg mb-6">
              03
            </div>
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-3" data-edit="about.val3.t" data-type="text">
              <?= e(t('about.val3.t', 'Pédagogie & transmission')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="about.val3.d" data-type="text">
              <?= e(t('about.val3.d', 'Notre objectif n\'est pas de vous rendre dépendants, mais de faire grandir vos équipes. Nous partageons nos astuces d\'outilleurs et formons vos régleurs pour ancrer le savoir-faire durablement.')) ?>
            </p>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 4: FAQ À PROPOS                    -->
    <!-- ========================================== -->
    <section class="py-20 border-t border-np-border bg-np-surface/40">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        
        <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text text-center mb-12" data-edit="about.faq.title" data-type="text">
          <?= e(t('about.faq.title', 'Questions fréquentes — NOVA PRESTIGE')) ?>
        </h2>

        <div class="space-y-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="about.faq.q1" data-type="text">
              <?= e(t('about.faq.q1', 'Pour quel profil d\'entreprises intervenez-vous ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="about.faq.a1" data-type="richtext">
              <?= t('about.faq.a1', 'Nous accompagnons aussi bien des ateliers artisanaux de tôlerie-serrurerie (5 à 15 salariés) ayant besoin d\'un appui BE ponctuel, que des usines industrielles de sous-traitance de plusieurs centaines de personnes cherchant à optimiser leurs cadences et former leurs opérateurs.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="about.faq.q2" data-type="text">
              <?= e(t('about.faq.q2', 'Quelle est la différence entre NOVA PRESTIGE et un bureau d\'études classique ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="about.faq.a2" data-type="richtext">
              <?= t('about.faq.a2', 'Un bureau d\'études généraliste dessine des pièces parfaites en 3D mais ignore souvent les limites physiques des presses plieuses (collisions, marques de vé, tonnages, retour élastique). NOVA PRESTIGE conçoit directement avec l\'œil du plieur et de l\'outilleur : nos pièces sont 100% fabricables sans reprise.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="about.faq.q3" data-type="text">
              <?= e(t('about.faq.q3', 'Comment s\'engage une première collaboration ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="about.faq.a3" data-type="richtext">
              <?= t('about.faq.a3', 'Nous commençons par un échange technique sans engagement (par téléphone, visioconférence ou directement dans votre atelier) pour analyser vos pièces ou vos problématiques. Nous établissons ensuite une proposition chiffrée claire et adaptée.') ?>
            </p>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- CTA FINAL SECTION                          -->
    <!-- ========================================== -->
    <section class="py-20 lg:py-24 bg-gradient-to-b from-np-surface to-np-bg">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl text-center">
        <h2 class="font-grotesk font-bold text-3xl sm:text-4xl text-np-text mb-5" data-edit="about.cta.title" data-type="text">
          <?= e(t('about.cta.title', 'Donnons une nouvelle dimension à vos fabrications')) ?>
        </h2>
        <p class="text-base text-np-text-muted max-w-2xl mx-auto mb-10 leading-relaxed" data-edit="about.cta.text" data-type="text">
          <?= e(t('about.cta.text', 'Rencontrez un expert tôlerie passionné et exigeant. Contactez-nous dès aujourd\'hui pour votre prochain défi technique.')) ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="/contact" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-xl transition-all duration-200">
            <span>Prendre contact avec nous</span>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
          <a href="/#expertises" class="inline-flex items-center justify-center px-6 py-4 text-sm font-medium text-np-text hover:text-np-accent transition-colors">
            <span>Explorer toutes nos expertises →</span>
          </a>
        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
