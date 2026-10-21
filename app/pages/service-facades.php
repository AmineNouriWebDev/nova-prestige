<?php
declare(strict_types=1);

$page_key = 'facades-metalliques-bardage-calepinage';
$seo_data = function_exists('seo') ? seo('facades-metalliques-bardage-calepinage') : [
    'title' => 'Façades métalliques, cassettes & calepinage de bardage | NOVA PRESTIGE',
    'description' => 'Études d\'enveloppe du bâtiment, calepinage de cassettes de façade, gestion de la dilatation thermique et fiches de pliage atelier. 40+ ans d\'expérience.',
    'canonical' => url('/facades-metalliques-bardage-calepinage')
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
          <span class="text-np-accent font-semibold">Façades & calepinage</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Text Column -->
          <div class="lg:col-span-7">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-5">
              <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
              <span data-edit="s3.hero.badge" data-type="text"><?= e(t('s3.hero.badge', 'Expertise Technique 03 — Enveloppe & Bardage')) ?></span>
            </div>

            <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-6 leading-tight" data-edit="s3.hero.title" data-type="text">
              <?= e(t('s3.hero.title', 'Façades métalliques, cassettes de bardage & calepinage architectural')) ?>
            </h1>

            <p class="text-base sm:text-lg text-np-text-muted leading-relaxed mb-8" data-edit="s3.hero.subtitle" data-type="richtext">
              <?= t('s3.hero.subtitle', 'Garantissez l\'alignement millimétrique de vos façades. NOVA PRESTIGE prend en charge l\'ingénierie complète de vos <strong>cassettes métalliques pliées, joints creux, bavettes et liaisons d\'acrotères</strong> pour une mise en œuvre sans surprise sur chantier.') ?>
            </p>

            <div class="flex flex-wrap items-center gap-4 mb-10">
              <a href="/contact?type=projet&service=facades" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-lg hover:shadow transition-all duration-200">
                <span data-edit="s3.hero.cta_quote" data-type="text"><?= e(t('s3.hero.cta_quote', 'Étudier un calepinage de façade')) ?></span>
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>

              <a href="#prestations" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-medium text-np-text hover:text-np-accent border border-np-border hover:border-np-accent rounded-xl transition-colors">
                <span>Détails & livrables ↓</span>
              </a>
            </div>

            <!-- Key Proof Points -->
            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-np-border/60">
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-accent" data-edit="s3.stat.val1" data-type="text"><?= e(t('s3.stat.val1', '0 reprise')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s3.stat.lbl1" data-type="text"><?= e(t('s3.stat.lbl1', 'Pose fluide sur chantier')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s3.stat.val2" data-type="text"><?= e(t('s3.stat.val2', 'Alu & Acier')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s3.stat.lbl2" data-type="text"><?= e(t('s3.stat.lbl2', 'Multi-matériaux')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s3.stat.val3" data-type="text"><?= e(t('s3.stat.val3', 'DTU 33.1')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s3.stat.lbl3" data-type="text"><?= e(t('s3.stat.lbl3', 'Règles de l\'art')) ?></span>
              </div>
            </div>

          </div>

          <!-- Hero Media Column -->
          <div class="lg:col-span-5">
            <?php 
              $hero_img = function_exists('img') ? img('s3.hero.image', '/assets/img/service-facades.webp', 'Calepinage de façade métallique et cassettes de bardage') : ['src' => '/assets/img/service-facades.webp', 'alt' => 'Façades métalliques et bardage']; 
            ?>
            <div class="rounded-2xl overflow-hidden border border-np-border bg-np-surface shadow-2xl relative group">
              <div class="aspect-[4/3] w-full relative overflow-hidden bg-slate-900">
                <img src="<?= e($hero_img['src']) ?>" 
                     alt="<?= e($hero_img['alt']) ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" 
                     loading="eager"
                     decoding="async"
                     data-edit="s3.hero.image" 
                     data-type="image">
                <div class="absolute inset-0 bg-gradient-to-t from-np-surface via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Emblem Top-Left -->
                <div class="absolute top-4 left-4 w-11 h-11 rounded-xl bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-np-accent shadow-xl z-10 pointer-events-none">
                  <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                  </svg>
                </div>
              </div>

              <div class="p-6 border-t border-np-border/60">
                <div class="flex items-center justify-between text-xs font-mono text-np-text-muted">
                  <span>SYSTÈMES MAÎTRISÉS :</span>
                  <span class="text-np-accent font-semibold">Cassettes • Bardage double peau • Clins</span>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s3.challenges.tag" data-type="text">
            <?= e(t('s3.challenges.tag', 'CONTRAINTES CRITIQUES DE CHANTIER')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s3.challenges.title" data-type="text">
            <?= e(t('s3.challenges.title', 'Les pièges d\'une façade mal calepinée en amont')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s3.challenges.intro" data-type="text">
            <?= e(t('s3.challenges.intro', 'Sur chantier, la reprise d\'une cassette de 3 mètres de haut coûte 10 fois plus cher que son étude. Nous supprimons les approximations dès la conception.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              01
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s3.chal.t1" data-type="text">
              <?= e(t('s3.chal.t1', 'Dilatation thermique et cloquage')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s3.chal.d1" data-type="text">
              <?= e(t('s3.chal.d1', 'L\'aluminium s\'allonge de 2,4 mm par mètre pour un écart de 100°C. Sans jeux de dilatation et lumières oblongues dimensionnés, les parements gondolent irrémédiablement.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              02
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s3.chal.t2" data-type="text">
              <?= e(t('s3.chal.t2', 'Décalage cumulé des joints creux')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s3.chal.d2" data-type="text">
              <?= e(t('s3.chal.d2', 'Une simple erreur d\'un demi-millimètre sur la découpe ou le pliage génère un désalignement de plusieurs centimètres au sommet d\'une façade de grande hauteur.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              03
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s3.chal.t3" data-type="text">
              <?= e(t('s3.chal.t3', 'Gestion bâclée des points singuliers')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s3.chal.d3" data-type="text">
              <?= e(t('s3.chal.d3', 'Les fuites et défauts d\'esthétique naissent aux liaisons : angles sortants à coupe d\'onglet, retours de tableaux de fenêtres et couvertines d\'acrotères mal étanchées.')) ?>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s3.deliverables.tag" data-type="text">
            <?= e(t('s3.deliverables.tag', 'LIVRABLES CHANTIER & ATELIER')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s3.deliverables.title" data-type="text">
            <?= e(t('s3.deliverables.title', 'Le dossier d\'exécution complet pour le plieur et le poseur')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s3.deliverables.intro" data-type="text">
            <?= e(t('s3.deliverables.intro', 'Chaque panneau possède son repère unique, son plan de débit à plat DXF et sa fiche de séquence de pliage.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
          
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s3.item1.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 01</span>
              <span>Carnet de calepinage & élévations cotées</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s3.item1.d" data-type="text">
              <?= e(t('s3.item1.d', 'Élévations complètes de chaque trame de façade avec repérage unitaire des cassettes (ex: A01, A02), cotes de fabrication et implantation des rails d\'ossature secondaire.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Vues d\'ensemble et coupes de principe horizontales / verticales
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Tableau récapitulatif des surfaces et métrés de bardage
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Positionnement précis des points fixes et points glissants
              </li>
            </ul>
          </div>

          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s3.item2.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 02</span>
              <span>Fiches de fabrication atelier (pliage & découpe)</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s3.item2.d" data-type="text">
              <?= e(t('s3.item2.d', 'Dossier prêt à envoyer aux ateliers de tôlerie : développés de pliage tenant compte des rayons et des grugeages de coins pour des angles parfaitement fermés sans surépaisseur.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Fichiers DXF 1:1 pour découpe laser ou poinçonnage
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Fiches de pliage avec angles, retraits et ordre des passes
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Plans de détail des bavettes, solins, couvertines et retours de tableau
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s3.method.tag" data-type="text">
            <?= e(t('s3.method.tag', 'MÉTHODOLOGIE D\'ENVELOPPE')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text mb-4" data-edit="s3.method.title" data-type="text">
            <?= e(t('s3.method.title', 'De l\'intention architecturale à la pose sans reprise')) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 01</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Relevé & analyse trame</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Examen des plans gros-œuvre, structure métallique et calage des trames principales.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 02</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Calepinage & joints</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Découpage en panneaux réguliers, intégration des jeux de pose et des points singuliers.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 03</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Dossier de pliage</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Génération des dépliés d'atelier avec prise en compte des outillages réels de pliage.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 04</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Accompagnement pose</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Assistance technique pour le démarrage du chantier et la résolution des imprévus.
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
        
        <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text text-center mb-12" data-edit="s3.faq.title" data-type="text">
          <?= e(t('s3.faq.title', 'Questions fréquentes — Façades & calepinage')) ?>
        </h2>

        <div class="space-y-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s3.faq.q1" data-type="text">
              <?= e(t('s3.faq.q1', 'Quelles épaisseurs de tôles privilégier pour des cassettes sans planéité dégradée ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s3.faq.a1" data-type="richtext">
              <?= t('s3.faq.a1', 'Pour l\'aluminium, nous recommandons généralement du 2,0 mm à 3,0 mm avec raidisseurs collés ou soudés selon les dimensions de la cassette pour éviter le phénomène d\'effet miroir ou de tôle qui bombe au vent.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s3.faq.q2" data-type="text">
              <?= e(t('s3.faq.q2', 'Prenez-vous en charge le relevé de cotes sur le chantier ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s3.faq.a2" data-type="richtext">
              <?= t('s3.faq.a2', 'Oui, nous pouvons intervenir sur site pour effectuer ou valider les relevés de structure existante avant lancement en fabrication, aussi bien en France qu\'en Tunisie et au Maghreb.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s3.faq.q3" data-type="text">
              <?= e(t('s3.faq.q3', 'Nos plieuses d\'atelier peuvent-elles réaliser des retours de cassettes à 90° et 45° ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s3.faq.a3" data-type="richtext">
              <?= t('s3.faq.a3', 'Nous analysons au préalable la hauteur des tabliers et la profondeur de dégagement de vos plieuses. Le dessin des grugeages de coins est calculé précisément pour que chaque cassette passe sans heurter le coulisseau.') ?>
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
        <h2 class="font-grotesk font-bold text-3xl sm:text-4xl text-np-text mb-5" data-edit="s3.cta.title" data-type="text">
          <?= e(t('s3.cta.title', 'Confiez votre calepinage de façade à un spécialiste tôlerie')) ?>
        </h2>
        <p class="text-base text-np-text-muted max-w-2xl mx-auto mb-10 leading-relaxed" data-edit="s3.cta.text" data-type="text">
          <?= e(t('s3.cta.text', 'Obtenez un dossier d\'exécution rigoureux garantissant l\'esthétique architecturale et la rapidité de montage sur site.')) ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="/contact?type=projet&service=facades" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-xl transition-all duration-200">
            <span>Demander un devis de calepinage</span>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
          <a href="/contact" class="inline-flex items-center justify-center px-6 py-4 text-sm font-medium text-np-text hover:text-np-accent transition-colors">
            <span>Discuter d\'un projet en cours →</span>
          </a>
        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
