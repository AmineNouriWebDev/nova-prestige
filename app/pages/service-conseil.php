<?php
declare(strict_types=1);

$page_key = 'conseil-industriel-equipements';
$seo_data = function_exists('seo') ? seo('conseil-industriel-equipements') : [
    'title' => 'Conseil industriel & audit presses plieuses et cisailles | NOVA PRESTIGE',
    'description' => 'Aide à l\'investissement machine 100% indépendante, audit géométrique de parcs plieuses et cisailles, cahier des charges CCTP. 40+ ans d\'expertise.',
    'canonical' => url('/conseil-industriel-equipements')
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
          <span class="text-np-accent font-semibold">Conseil & équipements</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Text Column -->
          <div class="lg:col-span-7">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-5">
              <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
              <span data-edit="s5.hero.badge" data-type="text"><?= e(t('s5.hero.badge', 'Expertise Technique 05 — Conseil Indépendant')) ?></span>
            </div>

            <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-6 leading-tight" data-edit="s5.hero.title" data-type="text">
              <?= e(t('s5.hero.title', 'Conseil industriel & audit d\'équipements : presses plieuses et cisailles')) ?>
            </h1>

            <p class="text-base sm:text-lg text-np-text-muted leading-relaxed mb-8" data-edit="s5.hero.subtitle" data-type="richtext">
              <?= t('s5.hero.subtitle', 'Bénéficiez d\'un avis technique 100% neutre et indépendant des constructeurs. NOVA PRESTIGE vous guide dans <strong>le choix de vos investissements machines, l\'audit géométrique de votre parc et la résolution de non-conformités complexes</strong>.') ?>
            </p>

            <div class="flex flex-wrap items-center gap-4 mb-10">
              <a href="/contact?type=projet&service=conseil" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-lg hover:shadow transition-all duration-200">
                <span data-edit="s5.hero.cta_quote" data-type="text"><?= e(t('s5.hero.cta_quote', 'Sécuriser un investissement machine')) ?></span>
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>

              <a href="#prestations" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-medium text-np-text hover:text-np-accent border border-np-border hover:border-np-accent rounded-xl transition-colors">
                <span>Audits & expertises ↓</span>
              </a>
            </div>

            <!-- Key Proof Points -->
            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-np-border/60">
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-accent" data-edit="s5.stat.val1" data-type="text"><?= e(t('s5.stat.val1', '100% Neutre')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s5.stat.lbl1" data-type="text"><?= e(t('s5.stat.lbl1', 'Zéro commission marque')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s5.stat.val2" data-type="text"><?= e(t('s5.stat.val2', '40+ ans')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s5.stat.lbl2" data-type="text"><?= e(t('s5.stat.lbl2', 'Connaissance machines')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s5.stat.val3" data-type="text"><?= e(t('s5.stat.val3', 'FAT & SAT')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s5.stat.lbl3" data-type="text"><?= e(t('s5.stat.lbl3', 'Réceptions qualifiées')) ?></span>
              </div>
            </div>

          </div>

          <!-- Hero Media Column -->
          <div class="lg:col-span-5">
            <?php 
              $hero_img = function_exists('img') ? img('s5.hero.image', '/assets/img/service-conseil.webp', 'Audit technique de presse plieuse industrielle') : ['src' => '/assets/img/service-conseil.webp', 'alt' => 'Conseil industriel et audit équipements']; 
            ?>
            <div class="rounded-2xl overflow-hidden border border-np-border bg-np-surface shadow-2xl relative group">
              <div class="aspect-[4/3] w-full relative overflow-hidden bg-slate-900">
                <img src="<?= e($hero_img['src']) ?>" 
                     alt="<?= e($hero_img['alt']) ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" 
                     loading="eager"
                     decoding="async"
                     data-edit="s5.hero.image" 
                     data-type="image">
                <div class="absolute inset-0 bg-gradient-to-t from-np-surface via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Emblem Top-Left -->
                <div class="absolute top-4 left-4 w-11 h-11 rounded-xl bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-np-accent shadow-xl z-10 pointer-events-none">
                  <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                  </svg>
                </div>
              </div>

              <div class="p-6 border-t border-np-border/60">
                <div class="flex items-center justify-between text-xs font-mono text-np-text-muted">
                  <span>MARQUES AUDITÉES :</span>
                  <span class="text-np-accent font-semibold">Amada • Bystronic • Trumpf • LVD • Safan</span>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s5.challenges.tag" data-type="text">
            <?= e(t('s5.challenges.tag', 'ENJEUX D\'INVESTISSEMENT')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s5.challenges.title" data-type="text">
            <?= e(t('s5.challenges.title', 'Évitez les erreurs d\'achat à plusieurs centaines de milliers d\'euros')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s5.challenges.intro" data-type="text">
            <?= e(t('s5.challenges.intro', 'Une presse plieuse mal dimensionnée ou mal optionnée hypothèque la rentabilité d\'une usine pour 15 ans. Nous défendons vos intérêts techniques face aux discours commerciaux.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              01
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s5.chal.t1" data-type="text">
              <?= e(t('s5.chal.t1', 'Sous-dimensionnement ou options superflues')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s5.chal.d1" data-type="text">
              <?= e(t('s5.chal.d1', 'Acheter un tonnage insuffisant bloque la fabrication de pièces épaisses ; à l\'inverse, payer pour des axes numériques inutiles alourdit le budget sans gain réel.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              02
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s5.chal.t2" data-type="text">
              <?= e(t('s5.chal.t2', 'Dérives géométriques invisibles')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s5.chal.d2" data-type="text">
              <?= e(t('s5.chal.d2', 'Sur un parc existant, un défaut de parallélisme du coulisseau ou un système de bombage hydraulique fatigué provoque des écarts d\'angle entre le centre et les extrémités du pli.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              03
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s5.chal.t3" data-type="text">
              <?= e(t('s5.chal.t3', 'Litiges de réception avec les constructeurs')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s5.chal.d3" data-type="text">
              <?= e(t('s5.chal.d3', 'Signer la réception définitive d\'une presse sans avoir réalisé les essais de capabilité sur vos pièces les plus exigeantes vous prive de tout recours ultérieur.')) ?>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s5.deliverables.tag" data-type="text">
            <?= e(t('s5.deliverables.tag', 'LIVRABLES DE CONSEIL')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s5.deliverables.title" data-type="text">
            <?= e(t('s5.deliverables.title', 'Une assistance experte du cahier des charges à la mise en service')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s5.deliverables.intro" data-type="text">
            <?= e(t('s5.deliverables.intro', 'Nous agissons comme votre direction technique déléguée pour arbitrer chaque décision avec rigueur.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
          
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s5.item1.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 01</span>
              <span>Cahier des charges (CCTP) & dépouillement d'offres</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s5.item1.d" data-type="text">
              <?= e(t('s5.item1.d', 'Rédaction d\'un cahier des charges précis basé sur vos plans et contraintes : tonnage utile, course, col de cygne, vitesse d\'approche, type de bombage et équipement de butée.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Grille comparative objective et notation technique des constructeurs
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Détection des coûts cachés (outillages propriétaires, licences logicielles)
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Accompagnement lors des négociations techniques
              </li>
            </ul>
          </div>

          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s5.item2.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 02</span>
              <span>Audit de parc existant & réceptions d\'équipements (FAT/SAT)</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s5.item2.d" data-type="text">
              <?= e(t('s5.item2.d', 'Audit physique et métrologique de vos presses plieuses et cisailles : mesure du jeu mécanique, état des glissières, linéarité du tablier et calibrage des sécurités.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Protocole de réception usine (FAT chez le constructeur)
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Réception sur votre site (SAT) avec pièces d\'essais critiques
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Expertise avant achat pour machines d\'occasion
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s5.method.tag" data-type="text">
            <?= e(t('s5.method.tag', 'PROCESSUS D\'ACCOMPAGNEMENT')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text mb-4" data-edit="s5.method.title" data-type="text">
            <?= e(t('s5.method.title', 'Une démarche indépendante et rigoureuse')) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 01</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Audit des besoins réels</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Examen de vos commandes actuelles et futures, épaisseurs, longueurs et matières traitées.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 02</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Rédaction du CCTP</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Établissement du document technique opposable aux fournisseurs en concurrence.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 03</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Dépouillement technique</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Analyse détaillée des propositions, identification des faiblesses et conseil de choix.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 04</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Réception & essais</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Tests de précision et signature du procès-verbal de réception sans réserve.
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
        
        <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text text-center mb-12" data-edit="s5.faq.title" data-type="text">
          <?= e(t('s5.faq.title', 'Questions fréquentes — Conseil industriel & équipements')) ?>
        </h2>

        <div class="space-y-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s5.faq.q1" data-type="text">
              <?= e(t('s5.faq.q1', 'Percevez-vous des commissions sur les ventes de machines ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s5.faq.a1" data-type="richtext">
              <?= t('s5.faq.a1', 'Jamais. Notre modèle repose exclusivement sur la rémunération d\'honoraires de conseil par nos clients industriels. Cette indépendance totale garantit notre neutralité et la défense exclusive de vos intérêts.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s5.faq.q2" data-type="text">
              <?= e(t('s5.faq.q2', 'Presse électrique ou presse hydraulique : comment choisir ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s5.faq.a2" data-type="richtext">
              <?= t('s5.faq.a2', 'La presse électrique excelle en vitesse et précision sur les petites pièces fines et moyennes (courses courtes, faible consommation). L\'hydraulique reste incontournable dès que les épaisseurs et longueurs augmentent. Nous calculons le seuil de rentabilité exact selon vos séries.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s5.faq.q3" data-type="text">
              <?= e(t('s5.faq.q3', 'Pouvez-vous expertiser une presse plieuse d\'occasion avant transaction ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s5.faq.a3" data-type="richtext">
              <?= t('s5.faq.a3', 'Oui, nous nous déplaçons chez le vendeur pour ausculter la machine : contrôle des jeux d\'usure, fuites de distributeurs, état des règles optiques, système de bombage et essais de pliage sous charge.') ?>
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
        <h2 class="font-grotesk font-bold text-3xl sm:text-4xl text-np-text mb-5" data-edit="s5.cta.title" data-type="text">
          <?= e(t('s5.cta.title', 'Sécurisez votre prochain investissement équipement')) ?>
        </h2>
        <p class="text-base text-np-text-muted max-w-2xl mx-auto mb-10 leading-relaxed" data-edit="s5.cta.text" data-type="text">
          <?= e(t('s5.cta.text', 'Faites appel à un expert indépendant pour auditer votre parc ou piloter l\'achat de votre prochaine presse plieuse.')) ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="/contact?type=projet&service=conseil" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-xl transition-all duration-200">
            <span>Demander un audit machine</span>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
          <a href="/contact" class="inline-flex items-center justify-center px-6 py-4 text-sm font-medium text-np-text hover:text-np-accent transition-colors">
            <span>Contacter notre expert indépendant →</span>
          </a>
        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
