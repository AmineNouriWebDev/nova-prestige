<?php
declare(strict_types=1);

$page_key = 'bureau-etudes-faisabilite';
$seo_data = function_exists('seo') ? seo('bureau-etudes-faisabilite') : [
    'title' => 'Bureau d\'études techniques & faisabilité industrielle | NOVA PRESTIGE',
    'description' => 'Études techniques, calculs de structures et analyse de fabricabilité pour la tôlerie industrielle, la métallerie et les façades. 40+ ans d\'expertise.',
    'canonical' => url('/bureau-etudes-faisabilite')
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
      <!-- Background subtle technical glow -->
      <div class="absolute inset-0 bg-radial-at-t from-np-primary/20 via-transparent to-transparent pointer-events-none"></div>

      <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-mono text-np-text-muted mb-6" aria-label="Fil d'Ariane">
          <a href="/" class="hover:text-np-accent transition-colors">Accueil</a>
          <span>/</span>
          <a href="/#expertises" class="hover:text-np-accent transition-colors">Expertises</a>
          <span>/</span>
          <span class="text-np-accent font-semibold">Bureau d'études & faisabilité</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Text Column -->
          <div class="lg:col-span-7">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-5">
              <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
              <span data-edit="s1.hero.badge" data-type="text"><?= e(t('s1.hero.badge', 'Expertise Technique 01 — Bureau d\'études')) ?></span>
            </div>

            <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-6 leading-tight" data-edit="s1.hero.title" data-type="text">
              <?= e(t('s1.hero.title', 'Bureau d\'études techniques & analyse de faisabilité industrielle')) ?>
            </h1>

            <p class="text-base sm:text-lg text-np-text-muted leading-relaxed mb-8" data-edit="s1.hero.subtitle" data-type="richtext">
              <?= t('s1.hero.subtitle', 'NOVA PRESTIGE transforme vos intentions architecturales et vos besoins industriels en <strong>dossiers techniques rigoureux, modélisés en 3D et directement fabricables</strong> sur vos équipements de tôlerie et de pliage.') ?>
            </p>

            <div class="flex flex-wrap items-center gap-4 mb-10">
              <a href="/contact?type=projet&service=bureau-etudes" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-lg hover:shadow transition-all duration-200">
                <span data-edit="s1.hero.cta_quote" data-type="text"><?= e(t('s1.hero.cta_quote', 'Étudier mon dossier technique')) ?></span>
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>

              <a href="#prestations" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-medium text-np-text hover:text-np-accent border border-np-border hover:border-np-accent rounded-xl transition-colors">
                <span>Découvrir les livrables ↓</span>
              </a>
            </div>

            <!-- Key Proof Points -->
            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-np-border/60">
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-accent" data-edit="s1.stat.val1" data-type="text"><?= e(t('s1.stat.val1', '40+ ans')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s1.stat.lbl1" data-type="text"><?= e(t('s1.stat.lbl1', 'Expérience terrain')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s1.stat.val2" data-type="text"><?= e(t('s1.stat.val2', '100%')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s1.stat.lbl2" data-type="text"><?= e(t('s1.stat.lbl2', 'Fabricabilité atelier')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s1.stat.val3" data-type="text"><?= e(t('s1.stat.val3', 'CAO 3D')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s1.stat.lbl3" data-type="text"><?= e(t('s1.stat.lbl3', 'STEP, DXF, DWG')) ?></span>
              </div>
            </div>

          </div>

          <!-- Hero Media Column -->
          <div class="lg:col-span-5">
            <?php 
              $hero_img = function_exists('img') ? img('s1.hero.image', '/assets/img/service-bureau-etudes.webp', 'Plans techniques et modélisation 3D en bureau d\'études') : ['src' => '/assets/img/service-bureau-etudes.webp', 'alt' => 'Bureau d\'études']; 
            ?>
            <div class="rounded-2xl overflow-hidden border border-np-border bg-np-surface shadow-2xl relative group">
              <div class="aspect-[4/3] w-full relative overflow-hidden bg-slate-900">
                <img src="<?= e($hero_img['src']) ?>" 
                     alt="<?= e($hero_img['alt']) ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" 
                     loading="eager"
                     decoding="async"
                     data-edit="s1.hero.image" 
                     data-type="image">
                <div class="absolute inset-0 bg-gradient-to-t from-np-surface via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Technical Emblem Top-Left -->
                <div class="absolute top-4 left-4 w-11 h-11 rounded-xl bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-np-accent shadow-xl z-10 pointer-events-none">
                  <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                </div>
              </div>

              <div class="p-6 border-t border-np-border/60">
                <div class="flex items-center justify-between text-xs font-mono text-np-text-muted">
                  <span>FORMATS LIVRÉS :</span>
                  <span class="text-np-accent font-semibold">STEP • DWG • DXF • PDF</span>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 2: ENJEUX & DÉFIS CLIENTS          -->
    <!-- ========================================== -->
    <section class="py-20 bg-np-surface/40 border-b border-np-border">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s1.challenges.tag" data-type="text">
            <?= e(t('s1.challenges.tag', 'PROBLÉMATIQUES TRAITÉES')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s1.challenges.title" data-type="text">
            <?= e(t('s1.challenges.title', 'Éliminez les blocages entre le bureau d\'études et l\'atelier')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s1.challenges.intro" data-type="text">
            <?= e(t('s1.challenges.intro', 'Un plan non fabricable entraîne des rebuts, des surcoûts de réglage machine et des arrêts de production. Notre intervention sécurise chaque étape avant lancement.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              01
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s1.chal.t1" data-type="text">
              <?= e(t('s1.chal.t1', 'Rayons & pertes au pli non maîtrisés')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s1.chal.d1" data-type="text">
              <?= e(t('s1.chal.d1', 'Intégration exacte du facteur K, du retrait au pliage et des capacités réelles de vos outillages de presse plieuse (vé, poinçon, bavette).')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              02
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s1.chal.t2" data-type="text">
              <?= e(t('s1.chal.t2', 'Gaspillage matière & découpes inadaptées')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s1.chal.d2" data-type="text">
              <?= e(t('s1.chal.d2', 'Optimisation du calepinage des tôles pour limiter les chutes, orienter le sens de laminage et éviter les criques sur aciers et aluminiums.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              03
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s1.chal.t3" data-type="text">
              <?= e(t('s1.chal.t3', 'Collisions d\'outillages lors du pliage')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s1.chal.d3" data-type="text">
              <?= e(t('s1.chal.d3', 'Simulation complète de la cinématique de pliage : séquencement des passes, dégagement des butées arrière et vérification des retours d\'ailes.')) ?>
            </p>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 3: PRESTATIONS & LIVRABLES         -->
    <!-- ========================================== -->
    <section id="prestations" class="py-20 lg:py-28">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        
        <div class="max-w-3xl mb-16">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s1.deliverables.tag" data-type="text">
            <?= e(t('s1.deliverables.tag', 'LIVRABLES CONCRETS')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s1.deliverables.title" data-type="text">
            <?= e(t('s1.deliverables.title', 'Ce que vous recevez pour chaque mission d\'études')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s1.deliverables.intro" data-type="text">
            <?= e(t('s1.deliverables.intro', 'Chaque prestation fait l\'objet d\'un dossier technique exhaustif, validé par un consultant senior et directement exploitable par vos opérateurs et programmeurs.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
          
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s1.item1.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 01</span>
              <span>Modélisation 3D CAO & plans de détails 2D</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s1.item1.d" data-type="text">
              <?= e(t('s1.item1.d', 'Conception intégrale sous SolidWorks/Inventor avec export des fichiers 3D natifs (STEP, IGES) et plans de fabrication 2D cotés selon les normes ISO GPS.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Fichiers dépliés DXF 1:1 pour découpe laser & poinçonnage
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Vues isométriques avec repérage des plis et sens de laminage
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Nomenclatures complètes (repères pièces, nuances, épaisseurs)
              </li>
            </ul>
          </div>

          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s1.item2.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 02</span>
              <span>Dossier d'analyse de fabricabilité & fiches de pliage</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s1.item2.d" data-type="text">
              <?= e(t('s1.item2.d', 'Définition des outillages requis pour chaque profil, calcul des tonnages nécessaires et établissement des fiches de pliage pas-à-pas pour les régleurs.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Choix des vés et rayons de poinçon adaptés à la matière
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Ordre d'enchaînement des plis avec repérage des butées
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Identification des outillages spéciaux si nécessaire
              </li>
            </ul>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 4: MÉTHODOLOGIE EN 4 ÉTAPES        -->
    <!-- ========================================== -->
    <section class="py-20 bg-np-surface/40 border-y border-np-border">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s1.method.tag" data-type="text">
            <?= e(t('s1.method.tag', 'MÉTHODOLOGIE DE TRAVAIL')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text mb-4" data-edit="s1.method.title" data-type="text">
            <?= e(t('s1.method.title', 'Un processus rigoureux en 4 étapes')) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 01</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Audit du besoin</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Examen de vos croquis, plans architectes ou pièces existantes. Recensement de votre parc machines.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 02</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Conception 3D & calculs</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Modélisation 3D fine, calcul des développés, intégration des tolérances et validation matière.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 03</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Simulation & validation</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Vérification des collisions, séquençage machine et validation conjointe avec vos équipes techniques.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 04</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Livrables & lancement</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Envoi du dossier complet prêt à charger dans vos commandes numériques et accompagnement opérateur.
            </p>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 5: FAQ SPÉCIFIQUE SERVICE          -->
    <!-- ========================================== -->
    <section class="py-20 border-b border-np-border">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        
        <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text text-center mb-12" data-edit="s1.faq.title" data-type="text">
          <?= e(t('s1.faq.title', 'Questions fréquentes — Bureau d\'études')) ?>
        </h2>

        <div class="space-y-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s1.faq.q1" data-type="text">
              <?= e(t('s1.faq.q1', 'Quels formats de fichiers devez-vous nous fournir ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s1.faq.a1" data-type="richtext">
              <?= t('s1.faq.a1', 'Nous pouvons partir de simples croquis cotés, de fichiers PDF, DWG, DXF ou de modèles 3D bruts. Nous nous adaptons à vos données sources.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s1.faq.q2" data-type="text">
              <?= e(t('s1.faq.q2', 'Prenez-vous en compte les outillages de notre propre atelier ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s1.faq.a2" data-type="richtext">
              <?= t('s1.faq.a2', 'Oui, c\'est le cœur de notre démarche. Nous réclamons la liste de vos vés, poinçons et caractéristiques machines afin que chaque pli soit immédiatement réalisable sur vos postes sans investissement inutile.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s1.faq.q3" data-type="text">
              <?= e(t('s1.faq.q3', 'Dans quels délais un dossier technique est-il livré ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s1.faq.a3" data-type="richtext">
              <?= t('s1.faq.a3', 'Les délais varient de 48h pour une analyse de profil spécifique à quelques jours pour un dossier complet de façade ou d\'assemblage mécano-soudé.') ?>
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
        <h2 class="font-grotesk font-bold text-3xl sm:text-4xl text-np-text mb-5" data-edit="s1.cta.title" data-type="text">
          <?= e(t('s1.cta.title', 'Sécurisez la faisabilité de votre prochain projet')) ?>
        </h2>
        <p class="text-base text-np-text-muted max-w-2xl mx-auto mb-10 leading-relaxed" data-edit="s1.cta.text" data-type="text">
          <?= e(t('s1.cta.text', 'Transmettez-nous vos plans pour une première revue technique sans engagement. Nous intervenons en France, en Tunisie et au Maghreb.')) ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="/contact?type=projet&service=bureau-etudes" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-xl transition-all duration-200">
            <span>Demander une étude de faisabilité</span>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
          <a href="/contact" class="inline-flex items-center justify-center px-6 py-4 text-sm font-medium text-np-text hover:text-np-accent transition-colors">
            <span>Contacter un consultant technique →</span>
          </a>
        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
