<?php
declare(strict_types=1);

$page_key = 'france-tunisie-maghreb';
$seo_data = function_exists('seo') ? seo('france-tunisie-maghreb') : [
    'title' => 'Zones d\'intervention : France, Tunisie & Maghreb | NOVA PRESTIGE',
    'description' => 'Missions sur site et études à distance pour l\'industrie métallurgique et la tôlerie en France, en Tunisie et au Maghreb. Réactivité et mobilité.',
    'canonical' => url('/france-tunisie-maghreb')
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
          <span class="text-np-accent font-semibold">Zones d'intervention</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Text Column -->
          <div class="lg:col-span-7">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-5">
              <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
              <span data-edit="zones.hero.badge" data-type="text"><?= e(t('zones.hero.badge', 'Mobilité Industrielle — France & Maghreb')) ?></span>
            </div>

            <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-6 leading-tight" data-edit="zones.hero.title" data-type="text">
              <?= e(t('zones.hero.title', 'Zones d\'intervention : France métropolitaine, Tunisie & Maghreb')) ?>
            </h1>

            <p class="text-base sm:text-lg text-np-text-muted leading-relaxed mb-8" data-edit="zones.hero.subtitle" data-type="richtext">
              <?= t('zones.hero.subtitle', 'Une présence technique active et agile des deux côtés de la Méditerranée. NOVA PRESTIGE intervient <strong>sur site en usine de tôlerie et sur chantiers de façades en France, en Tunisie et dans tout le Maghreb</strong>, ainsi qu\'en télétravail technique sécurisé.') ?>
            </p>

            <div class="flex flex-wrap items-center gap-4 mb-10">
              <a href="/contact?type=projet" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-lg hover:shadow transition-all duration-200">
                <span data-edit="zones.hero.cta_quote" data-type="text"><?= e(t('zones.hero.cta_quote', 'Planifier une intervention sur site')) ?></span>
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>

              <a href="#modalites" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-medium text-np-text hover:text-np-accent border border-np-border hover:border-np-accent rounded-xl transition-colors">
                <span>Modalités & couverture ↓</span>
              </a>
            </div>

            <!-- Key Proof Points -->
            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-np-border/60">
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-accent" data-edit="zones.stat.val1" data-type="text"><?= e(t('zones.stat.val1', 'France & Tunisie')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="zones.stat.lbl1" data-type="text"><?= e(t('zones.stat.lbl1', 'Bases opérationnelles')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="zones.stat.val2" data-type="text"><?= e(t('zones.stat.val2', 'Sous 48h')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="zones.stat.lbl2" data-type="text"><?= e(t('zones.stat.lbl2', 'Réactivité d\'urgence')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="zones.stat.val3" data-type="text"><?= e(t('zones.stat.val3', 'Bilingue')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="zones.stat.lbl3" data-type="text"><?= e(t('zones.stat.lbl3', 'Français & Arabe pro')) ?></span>
              </div>
            </div>

          </div>

          <!-- Hero Media Column -->
          <div class="lg:col-span-5">
            <?php 
              $hero_img = function_exists('img') ? img('zones.hero.image', '/assets/img/home-zones.webp', 'Carte et mobilité industrielle France Tunisie Maghreb') : ['src' => '/assets/img/home-zones.webp', 'alt' => 'Zones d\'intervention France Tunisie Maghreb']; 
            ?>
            <div class="rounded-2xl overflow-hidden border border-np-border bg-np-surface shadow-2xl relative group">
              <div class="aspect-[4/3] w-full relative overflow-hidden bg-slate-900">
                <img src="<?= e($hero_img['src']) ?>" 
                     alt="<?= e($hero_img['alt']) ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" 
                     loading="eager"
                     decoding="async"
                     data-edit="zones.hero.image" 
                     data-type="image">
                <div class="absolute inset-0 bg-gradient-to-t from-np-surface via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Emblem Top-Left -->
                <div class="absolute top-4 left-4 w-11 h-11 rounded-xl bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-np-accent shadow-xl z-10 pointer-events-none">
                  <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
              </div>

              <div class="p-6 border-t border-np-border/60">
                <div class="flex items-center justify-between text-xs font-mono text-np-text-muted">
                  <span>DISPONIBILITÉ :</span>
                  <span class="text-np-accent font-semibold">Sur site & Distanciel sécurisé</span>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 2: LES 3 PÔLES GÉOGRAPHIQUES       -->
    <!-- ========================================== -->
    <section id="poles" class="py-20 bg-np-surface/40 border-b border-np-border">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="zones.poles.tag" data-type="text">
            <?= e(t('zones.poles.tag', 'COUVERTURE GÉOGRAPHIQUE')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="zones.poles.title" data-type="text">
            <?= e(t('zones.poles.title', 'Une expertise industrielle adaptée aux spécificités de chaque territoire')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="zones.poles.intro" data-type="text">
            <?= e(t('zones.poles.intro', 'Que vous soyez un façadier parisien, une tôlerie en région Auvergne-Rhône-Alpes ou un industriel en zone franche en Tunisie, nous adaptons notre intervention à vos impératifs.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <!-- France -->
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/30 text-blue-400 font-mono text-xs font-bold mb-5">
              FRANCE MÉTROPOLITAINE
            </div>
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-3" data-edit="zones.fr.title" data-type="text">
              <?= e(t('zones.fr.title', 'Tôleries, façadiers & métalleries')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="zones.fr.desc" data-type="text">
              <?= e(t('zones.fr.desc', 'Interventions sur l\'ensemble du territoire national (Île-de-France, Hauts-de-France, Rhône-Alpes, Grand-Est, PACA, Nouvelle-Aquitaine). Missions d\'expertise technique, dépouillement CCTP, formation des équipes et calepinage architectural conforme aux DTU.')) ?>
            </p>
            <ul class="space-y-2 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Déplacements rapides sur vos sites de production</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Relevés de cotes sur chantiers de façades</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Parfaite maîtrise des normes AFNOR / EN</li>
            </ul>
          </div>

          <!-- Tunisie -->
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-red-500/10 border border-red-500/30 text-red-400 font-mono text-xs font-bold mb-5">
              TUNISIE (GRAND TUNIS, SOUSSE, SFAX)
            </div>
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-3" data-edit="zones.tn.title" data-type="text">
              <?= e(t('zones.tn.title', 'Usines de tôlerie & sous-traitance')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="zones.tn.desc" data-type="text">
              <?= e(t('zones.tn.desc', 'Ancrage solide et proximité constante. Accompagnement des sous-traitants tunisiens exportant vers l\'Europe. Structuration des bureaux d\'études, audit et mise à niveau de parcs de presses plieuses, formation pratique des régleurs en atelier.')) ?>
            </p>
            <ul class="space-y-2 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Présence locale directe et missions sur site</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Formations bilingues français / arabe</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Mise aux standards européens pour l\'export</li>
            </ul>
          </div>

          <!-- Maghreb -->
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 font-mono text-xs font-bold mb-5">
              MAGHREB & INTERNATIONAL
            </div>
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-3" data-edit="zones.mag.title" data-type="text">
              <?= e(t('zones.mag.title', 'Algérie, Maroc & Projets Export')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="zones.mag.desc" data-type="text">
              <?= e(t('zones.mag.desc', 'Missions de conseil industriel, audits d\'usines de transformation de tôle, assistance au choix d\'équipements neufs ou d\'occasion et transfert de savoir-faire technique pour des projets industriels de grande envergure.')) ?>
            </p>
            <ul class="space-y-2 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Missions ciblées de 3 à 10 jours sur site</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Suivi dématérialisé des dossiers de fabrication</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Indépendance totale vis-à-vis des marchands</li>
            </ul>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 3: MODES D'INTERVENTION            -->
    <!-- ========================================== -->
    <section id="modalites" class="py-20 lg:py-28">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        
        <div class="max-w-3xl mb-16">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="zones.modes.tag" data-type="text">
            <?= e(t('zones.modes.tag', 'FLEXIBILITÉ OPÉRATIONNELLE')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="zones.modes.title" data-type="text">
            <?= e(t('zones.modes.title', 'Deux modes d\'intervention selon la nature de vos projets')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="zones.modes.intro" data-type="text">
            <?= e(t('zones.modes.intro', 'Nous combinons la puissance des outils numériques et la présence physique sur le terrain pour vous offrir un service fluide et économique.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
          
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="zones.mode1.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 01</span>
              <span>Intervention sur site (In situ)</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="zones.mode1.d" data-type="text">
              <?= e(t('zones.mode1.d', 'Idéale pour les formations pratiques d\'opérateurs, les audits de parcs de presses plieuses, les relevés de chantiers complexes et les réceptions de machines neuves ou d\'occasion.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Immersion directe au pied de vos machines</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Échanges en temps réel avec vos chefs d\'équipe et régleurs</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Forfaits de mission transparents incluant transport et hébergement</li>
            </ul>
          </div>

          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="zones.mode2.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 02</span>
              <span>Télétravail technique & bureau d\'études dématérialisé</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="zones.mode2.d" data-type="text">
              <?= e(t('zones.mode2.d', 'Parfaitement adapté aux études de faisabilité, aux modélisations CAO 3D, aux dossiers de calepinage de cassettes et aux fiches de pliage dématérialisées.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Réactivité immédiate sous 24h à 48h sans frais de déplacement</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Revues techniques partagées par visioconférence et écrans interactifs</li>
              <li class="flex items-center gap-2"><span class="text-np-accent">✓</span> Envois de fichiers par plateformes sécurisées (STEP, DWG, DXF, PDF)</li>
            </ul>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 4: FAQ SPÉCIFIQUE ZONES            -->
    <!-- ========================================== -->
    <section class="py-20 border-y border-np-border bg-np-surface/40">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        
        <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text text-center mb-12" data-edit="zones.faq.title" data-type="text">
          <?= e(t('zones.faq.title', 'Questions fréquentes — Mobilité & interventions')) ?>
        </h2>

        <div class="space-y-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="zones.faq.q1" data-type="text">
              <?= e(t('zones.faq.q1', 'Comment sont calculés les frais de déplacement lors d\'une mission sur site ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="zones.faq.a1" data-type="richtext">
              <?= t('zones.faq.a1', 'Nos devis indiquent un forfait clair et tout compris (transport, hébergement, restauration) sans surcoût masqué. Nous optimisons nos tournées pour mutualiser les coûts dans la mesure du possible.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="zones.faq.q2" data-type="text">
              <?= e(t('zones.faq.q2', 'Peut-on démarrer un projet à distance et finaliser sur place ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="zones.faq.a2" data-type="richtext">
              <?= t('zones.faq.a2', 'C\'est notre formule hybride la plus plébiscitée : nous cadrons l\'étude et modélisons les plans à distance pour réduire les coûts, puis nous nous déplaçons 1 ou 2 jours dans votre atelier pour valider les premiers pliages avec vos opérateurs.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="zones.faq.q3" data-type="text">
              <?= e(t('zones.faq.q3', 'Dans quels délais pouvez-vous intervenir en cas de blocage urgent ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="zones.faq.a3" data-type="richtext">
              <?= t('zones.faq.a3', 'En cas d\'urgence chantier ou arrêt de production critique, une première analyse de vos plans peut être réalisée sous quelques heures à distance, avec une possibilité de déplacement sur site sous 48h en France ou en Tunisie.') ?>
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
        <h2 class="font-grotesk font-bold text-3xl sm:text-4xl text-np-text mb-5" data-edit="zones.cta.title" data-type="text">
          <?= e(t('zones.cta.title', 'Vous avez un projet en France, en Tunisie ou au Maghreb ?')) ?>
        </h2>
        <p class="text-base text-np-text-muted max-w-2xl mx-auto mb-10 leading-relaxed" data-edit="zones.cta.text" data-type="text">
          <?= e(t('zones.cta.text', 'Contactez-nous pour échanger sur vos besoins techniques. Nous établissons un devis d\'intervention personnalisé sous 24h.')) ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="/contact" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-xl transition-all duration-200">
            <span>Demander une proposition d'intervention</span>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
          <a href="/contact?type=projet" class="inline-flex items-center justify-center px-6 py-4 text-sm font-medium text-np-text hover:text-np-accent transition-colors">
            <span>Planifier une visio technique →</span>
          </a>
        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
