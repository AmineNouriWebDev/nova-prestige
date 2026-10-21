<?php
declare(strict_types=1);

$page_key = 'methodes-industrialisation';
$seo_data = function_exists('seo') ? seo('methodes-industrialisation') : [
    'title' => 'Méthodes & industrialisation tôlerie : productivité atelier | NOVA PRESTIGE',
    'description' => 'Optimisation des gammes de pliage, standardisation d\'outillages de presses plieuses et réduction des temps de calage. 40+ ans d\'expertise atelier.',
    'canonical' => url('/methodes-industrialisation')
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
          <a href="/#expertises" class="hover:text-np-accent transition-colors">Expertises</a>
          <span>/</span>
          <span class="text-np-accent font-semibold">Méthodes & industrialisation</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Text Column -->
          <div class="lg:col-span-7">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-5">
              <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
              <span data-edit="s4.hero.badge" data-type="text"><?= e(t('s4.hero.badge', 'Expertise Technique 04 — Méthodes & Process')) ?></span>
            </div>

            <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-6 leading-tight" data-edit="s4.hero.title" data-type="text">
              <?= e(t('s4.hero.title', 'Méthodes & industrialisation de tôlerie : productivité, gammes et répétabilité')) ?>
            </h1>

            <p class="text-base sm:text-lg text-np-text-muted leading-relaxed mb-8" data-edit="s4.hero.subtitle" data-type="richtext">
              <?= t('s4.hero.subtitle', 'Passez de l\'empirisme à la maîtrise industrielle. NOVA PRESTIGE structure vos <strong>gammes opératoires de pliage, standardise vos outillages et élimine les temps d\'arrêt superflus</strong> sur vos presses plieuses et cisailles.') ?>
            </p>

            <div class="flex flex-wrap items-center gap-4 mb-10">
              <a href="/contact?type=projet&service=methodes" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-lg hover:shadow transition-all duration-200">
                <span data-edit="s4.hero.cta_quote" data-type="text"><?= e(t('s4.hero.cta_quote', 'Optimiser mon atelier tôlerie')) ?></span>
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>

              <a href="#prestations" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-medium text-np-text hover:text-np-accent border border-np-border hover:border-np-accent rounded-xl transition-colors">
                <span>Méthodologie & gains ↓</span>
              </a>
            </div>

            <!-- Key Proof Points -->
            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-np-border/60">
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-accent" data-edit="s4.stat.val1" data-type="text"><?= e(t('s4.stat.val1', '-30% à -50%')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s4.stat.lbl1" data-type="text"><?= e(t('s4.stat.lbl1', 'Temps de calage machine')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s4.stat.val2" data-type="text"><?= e(t('s4.stat.val2', '100% Écrit')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s4.stat.lbl2" data-type="text"><?= e(t('s4.stat.lbl2', 'Gammes standardisées')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s4.stat.val3" data-type="text"><?= e(t('s4.stat.val3', 'Bon du 1er coup')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s4.stat.lbl3" data-type="text"><?= e(t('s4.stat.lbl3', 'Chutes et rebuts réduits')) ?></span>
              </div>
            </div>

          </div>

          <!-- Hero Media Column -->
          <div class="lg:col-span-5">
            <?php 
              $hero_img = function_exists('img') ? img('s4.hero.image', '/assets/img/service-methodes.webp', 'Organisation des méthodes et outillages de presse plieuse') : ['src' => '/assets/img/service-methodes.webp', 'alt' => 'Méthodes et industrialisation de tôlerie']; 
            ?>
            <div class="rounded-2xl overflow-hidden border border-np-border bg-np-surface shadow-2xl relative group">
              <div class="aspect-[4/3] w-full relative overflow-hidden bg-slate-900">
                <img src="<?= e($hero_img['src']) ?>" 
                     alt="<?= e($hero_img['alt']) ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" 
                     loading="eager"
                     decoding="async"
                     data-edit="s4.hero.image" 
                     data-type="image">
                <div class="absolute inset-0 bg-gradient-to-t from-np-surface via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Emblem Top-Left -->
                <div class="absolute top-4 left-4 w-11 h-11 rounded-xl bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-np-accent shadow-xl z-10 pointer-events-none">
                  <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
              </div>

              <div class="p-6 border-t border-np-border/60">
                <div class="flex items-center justify-between text-xs font-mono text-np-text-muted">
                  <span>OUTILS OPTIMISÉS :</span>
                  <span class="text-np-accent font-semibold">SMED • Gammes de pliage • Abaques de force</span>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s4.challenges.tag" data-type="text">
            <?= e(t('s4.challenges.tag', 'FREINS DE PRODUCTION IDENTIFIÉS')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s4.challenges.title" data-type="text">
            <?= e(t('s4.challenges.title', 'Pourquoi vos presses plieuses ne tournent pas à leur pleine capacité')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s4.challenges.intro" data-type="text">
            <?= e(t('s4.challenges.intro', 'Dans la majorité des ateliers de tôlerie, une presse passe plus de temps à être réglée qu\'à plier de la tôle. Nous transformons ce goulot d\'étranglement en levier de rentabilité.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              01
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s4.chal.t1" data-type="text">
              <?= e(t('s4.chal.t1', 'Temps de changement d\'outils excessifs')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s4.chal.d1" data-type="text">
              <?= e(t('s4.chal.d1', 'Multiplication anarchique des références de vés et de poinçons. L\'opérateur passe 40 minutes à changer les outillages pour une série qui ne dure que 20 minutes.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              02
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s4.chal.t2" data-type="text">
              <?= e(t('s4.chal.t2', 'Perte du savoir-faire et mémoire orale')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s4.chal.d2" data-type="text">
              <?= e(t('s4.chal.d2', 'Si votre régleur senior est absent, l\'atelier s\'arrête ou produit des pièces non conformes. L\'absence de gammes écrites fragilise toute la structure.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              03
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s4.chal.t3" data-type="text">
              <?= e(t('s4.chal.t3', 'Rebuts systématiques au démarrage')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s4.chal.d3" data-type="text">
              <?= e(t('s4.chal.d3', 'Deux à trois pièces d\'essai sacrifiées à chaque nouvelle commande pour trouver le bon angle et la bonne compensation. Une hémorragie de matière et de temps.')) ?>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s4.deliverables.tag" data-type="text">
            <?= e(t('s4.deliverables.tag', 'LIVRABLES MÉTHODES')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s4.deliverables.title" data-type="text">
            <?= e(t('s4.deliverables.title', 'Des méthodes concrètes implantées directement à l\'atelier')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s4.deliverables.intro" data-type="text">
            <?= e(t('s4.deliverables.intro', 'Nous ne produisons pas de théorie inapplicable : chaque gamme est testée et validée avec vos opérateurs sur leurs propres machines.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
          
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s4.item1.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 01</span>
              <span>Gammes opératoires de pliage standardisées</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s4.item1.d" data-type="text">
              <?= e(t('s4.item1.d', 'Chaque pièce dispose d\'une fiche standard détaillant la référence exacte du poinçon et du vé, le sens d\'introduction de la tôle, la position des butées arrière et la séquence chronologique des plis.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Photos des montages complexes et des butées escamotables
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Préréglages numériques consignés (valeurs de correction d\'angle)
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Zéro ambiguïté pour les opérateurs débutants ou intérimaires
              </li>
            </ul>
          </div>

          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s4.item2.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 02</span>
              <span>Rationalisation des outillages & démarche SMED</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s4.item2.d" data-type="text">
              <?= e(t('s4.item2.d', 'Audit complet de vos armoires d\'outillages. Regroupement des pièces par familles géométriques pour plier un maximum de références avec un nombre minimal de montages d\'outils.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Définition du parc d\'outillage universel (vé multi-ouvertures, poinçon standard)
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Procédure de changement rapide d\'outils (SMED adapté au pliage)
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Étiquetage et rangement visuel 5S des fractions d\'outils
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s4.method.tag" data-type="text">
            <?= e(t('s4.method.tag', 'CYCLE D\'INDUSTRIALISATION')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text mb-4" data-edit="s4.method.title" data-type="text">
            <?= e(t('s4.method.title', 'Comment nous transformons votre atelier')) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 01</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Chronométrage & audit</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Observation des postes plieuses : mesure des temps masqués, recherches d'outils et essais.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 02</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Standardisation outillage</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Sélection d'une gamme resserrée de poinçons/vés et élimination des doublons inutiles.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 03</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Rédaction des gammes</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Création des fiches opératoires visuelles et intégration dans vos dossiers de fabrication.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 04</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Accompagnement régleurs</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Formation sur machine et suivi des indicateurs de temps de calage sur 30 jours.
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
        
        <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text text-center mb-12" data-edit="s4.faq.title" data-type="text">
          <?= e(t('s4.faq.title', 'Questions fréquentes — Méthodes & industrialisation')) ?>
        </h2>

        <div class="space-y-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s4.faq.q1" data-type="text">
              <?= e(t('s4.faq.q1', 'Quel retour sur investissement attendre d\'une mission méthodes ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s4.faq.a1" data-type="richtext">
              <?= t('s4.faq.a1', 'Dans les ateliers où les réglages étaient empiriques, nous constatons en moyenne une réduction de 30% à 50% du temps de mise en train de la presse plieuse, un gain de capacité équivalent à l\'achat d\'une demi-machine supplémentaire, sans investissement lourd.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s4.faq.q2" data-type="text">
              <?= e(t('s4.faq.q2', 'Vos gammes sont-elles compatibles avec nos logiciels de FAO (AutoPOL, Radan, Bendex...) ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s4.faq.a2" data-type="richtext">
              <?= t('s4.faq.a2', 'Parfaitement. Nous paramétrons vos bibliothèques d\'outils et vos tables de perte au pli directement dans vos logiciels de programmation hors-ligne pour que la simulation FAO concorde à 100% avec la réalité atelier.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s4.faq.q3" data-type="text">
              <?= e(t('s4.faq.q3', 'Comment faire adhérer les anciens régleurs au changement ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s4.faq.a3" data-type="richtext">
              <?= t('s4.faq.a3', 'Notre intervenant parle le même langage qu\'eux : 40 ans d\'expérience terrain. Nous ne venons pas imposer des règles bureaucratiques, mais valoriser leur travail en éliminant leurs tâches pénibles et répétitives.') ?>
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
        <h2 class="font-grotesk font-bold text-3xl sm:text-4xl text-np-text mb-5" data-edit="s4.cta.title" data-type="text">
          <?= e(t('s4.cta.title', 'Libérez le plein potentiel productif de vos plieuses')) ?>
        </h2>
        <p class="text-base text-np-text-muted max-w-2xl mx-auto mb-10 leading-relaxed" data-edit="s4.cta.text" data-type="text">
          <?= e(t('s4.cta.text', 'Réduisez vos temps de calage et fiabilisez vos pièces dès aujourd\'hui. Contactez-nous pour un diagnostic rapide de votre atelier.')) ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="/contact?type=projet&service=methodes" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-xl transition-all duration-200">
            <span>Demander un diagnostic atelier</span>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
          <a href="/contact" class="inline-flex items-center justify-center px-6 py-4 text-sm font-medium text-np-text hover:text-np-accent transition-colors">
            <span>Échanger avec un consultant méthodes →</span>
          </a>
        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
