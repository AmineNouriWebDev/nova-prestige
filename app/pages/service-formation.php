<?php
declare(strict_types=1);

$page_key = 'formation-technique-atelier';
$seo_data = function_exists('seo') ? seo('formation-technique-atelier') : [
    'title' => 'Formation technique pliage sur presse plieuse en atelier | NOVA PRESTIGE',
    'description' => 'Formation pratique sur site pour opérateurs et régleurs en tôlerie industrielle. Réglages, retour élastique, outillages et sécurité. 40+ ans d\'expérience.',
    'canonical' => url('/formation-technique-atelier')
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
          <span class="text-np-accent font-semibold">Formation technique</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Text Column -->
          <div class="lg:col-span-7">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-5">
              <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
              <span data-edit="s6.hero.badge" data-type="text"><?= e(t('s6.hero.badge', 'Expertise Technique 06 — Compétences Terrain')) ?></span>
            </div>

            <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-6 leading-tight" data-edit="s6.hero.title" data-type="text">
              <?= e(t('s6.hero.title', 'Formation technique en atelier : perfectionnement au pliage et réglage')) ?>
            </h1>

            <p class="text-base sm:text-lg text-np-text-muted leading-relaxed mb-8" data-edit="s6.hero.subtitle" data-type="richtext">
              <?= t('s6.hero.subtitle', 'Transmettez l\'art et la rigueur du pliage à vos équipes. NOVA PRESTIGE forme vos <strong>opérateurs, régleurs et techniciens méthodes directement sur vos presses plieuses</strong>, avec des cas pratiques issus de votre production réelle.') ?>
            </p>

            <div class="flex flex-wrap items-center gap-4 mb-10">
              <a href="/contact?type=formation&service=formation" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-lg hover:shadow transition-all duration-200">
                <span data-edit="s6.hero.cta_quote" data-type="text"><?= e(t('s6.hero.cta_quote', 'Organiser une session de formation')) ?></span>
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>

              <a href="#prestations" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-medium text-np-text hover:text-np-accent border border-np-border hover:border-np-accent rounded-xl transition-colors">
                <span>Modules & compétences ↓</span>
              </a>
            </div>

            <!-- Key Proof Points -->
            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-np-border/60">
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-accent" data-edit="s6.stat.val1" data-type="text"><?= e(t('s6.stat.val1', '100% Pratique')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s6.stat.lbl1" data-type="text"><?= e(t('s6.stat.lbl1', 'Sur vos machines')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s6.stat.val2" data-type="text"><?= e(t('s6.stat.val2', 'Opérateurs')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s6.stat.lbl2" data-type="text"><?= e(t('s6.stat.lbl2', 'Tous niveaux')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s6.stat.val3" data-type="text"><?= e(t('s6.stat.val3', 'Autonomie')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s6.stat.lbl3" data-type="text"><?= e(t('s6.stat.lbl3', 'Garantie après stage')) ?></span>
              </div>
            </div>

          </div>

          <!-- Hero Media Column -->
          <div class="lg:col-span-5">
            <?php 
              $hero_img = function_exists('img') ? img('s6.hero.image', '/assets/img/service-formation.webp', 'Formation pratique opérateur sur presse plieuse industrielle') : ['src' => '/assets/img/service-formation.webp', 'alt' => 'Formation technique atelier']; 
            ?>
            <div class="rounded-2xl overflow-hidden border border-np-border bg-np-surface shadow-2xl relative group">
              <div class="aspect-[4/3] w-full relative overflow-hidden bg-slate-900">
                <img src="<?= e($hero_img['src']) ?>" 
                     alt="<?= e($hero_img['alt']) ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" 
                     loading="eager"
                     decoding="async"
                     data-edit="s6.hero.image" 
                     data-type="image">
                <div class="absolute inset-0 bg-gradient-to-t from-np-surface via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Emblem Top-Left -->
                <div class="absolute top-4 left-4 w-11 h-11 rounded-xl bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-np-accent shadow-xl z-10 pointer-events-none">
                  <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                  </svg>
                </div>
              </div>

              <div class="p-6 border-t border-np-border/60">
                <div class="flex items-center justify-between text-xs font-mono text-np-text-muted">
                  <span>FORMAT :</span>
                  <span class="text-np-accent font-semibold">Intra-entreprise sur site • 1 à 4 pers.</span>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s6.challenges.tag" data-type="text">
            <?= e(t('s6.challenges.tag', 'PÉNURIE DE COMPÉTENCES & QUALITÉ')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s6.challenges.title" data-type="text">
            <?= e(t('s6.challenges.title', 'Le pliage ne s\'improvise pas : l\'erreur coûte cher')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s6.challenges.intro" data-type="text">
            <?= e(t('s6.challenges.intro', 'Confier une presse plieuse à un opérateur non formé génère des pièces hors tolérances, des casses d\'outils et des risques graves d\'accidents du travail.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              01
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s6.chal.t1" data-type="text">
              <?= e(t('s6.chal.t1', 'Pénurie de régleurs qualifiés')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s6.chal.d1" data-type="text">
              <?= e(t('s6.chal.d1', 'Les écoles forment peu ou pas aux subtilités de la presse plieuse. La solution la plus efficace consiste à monter en compétences vos propres opérateurs motivés.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              02
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s6.chal.t2" data-type="text">
              <?= e(t('s6.chal.t2', 'Méconnaissance des règles mécaniques')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s6.chal.d2" data-type="text">
              <?= e(t('s6.chal.d2', 'Choisir un vé trop étroit fait exploser la force nécessaire et marque la pièce ; forcer sur un rayon intérieur trop vif déchire la tôle au pliage.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              03
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s6.chal.t3" data-type="text">
              <?= e(t('s6.chal.t3', 'Détérioration d\'outillages de précision')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s6.chal.d3" data-type="text">
              <?= e(t('s6.chal.d3', 'Une mauvaise programmation de descente ou une collision avec une butée arrière détruit des poinçons fractionnés valant plusieurs milliers d\'euros.')) ?>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s6.deliverables.tag" data-type="text">
            <?= e(t('s6.deliverables.tag', 'PROGRAMME PÉDAGOGIQUE')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s6.deliverables.title" data-type="text">
            <?= e(t('s6.deliverables.title', 'Les modules clés de notre formation pratique')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s6.deliverables.intro" data-type="text">
            <?= e(t('s6.deliverables.intro', 'Un apprentissage 20% théorique et 80% pratique, centré sur la gestuelle, les réglages et le contrôle qualité immédiat.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
          
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s6.item1.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 01</span>
              <span>Fondamentaux mécaniques & lecture de plans</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s6.item1.d" data-type="text">
              <?= e(t('s6.item1.d', 'Comprendre le comportement de la matière : fibre neutre, facteur K, retour élastique selon les nuances (acier, alu, inox), calcul de l\'effort de pliage et choix du vé optimal (règle des 8x ou 6x l\'épaisseur).')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Détermination autonome de la séquence logique de pliage
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Réglage du bombage hydraulique ou mécanique
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Gestion des retours d\'ailes et évitement des collisions
              </li>
            </ul>
          </div>

          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s6.item2.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 02</span>
              <span>Pratique machine, métrologie & sécurité au poste</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s6.item2.d" data-type="text">
              <?= e(t('s6.item2.d', 'Montage et alignement parfait des outillages, prise d\'origine des butées, étalonnage des angles au rapporteur d\'angle optique et règles strictes de sécurité pour la protection des mains.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Utilisation des barrages immatériels et lasers de sécurité
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Contrôle dimensionnel de la 1ère pièce (autocontrôle opérateur)
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Remise du livret technique personnel à chaque stagiaire
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s6.method.tag" data-type="text">
            <?= e(t('s6.method.tag', 'PARCOURS D\'APPRENTISSAGE')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text mb-4" data-edit="s6.method.title" data-type="text">
            <?= e(t('s6.method.title', 'Une montée en compétences structurée en 4 étapes')) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 01</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Test de positionnement</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Évaluation initiale individuelle pour adapter le rythme et cibler les lacunes précises.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 02</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Théorie appliquée</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Calculs simples et abaques directes sans formules abstraites inutiles.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 03</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Pratique intensive</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Mise en situation sur vos séries de pièces réelles avec correction en temps réel.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 04</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Bilan & attestation</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Épreuve de validation pratique et restitution au responsable de production.
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
        
        <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text text-center mb-12" data-edit="s6.faq.title" data-type="text">
          <?= e(t('s6.faq.title', 'Questions fréquentes — Formation technique atelier')) ?>
        </h2>

        <div class="space-y-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s6.faq.q1" data-type="text">
              <?= e(t('s6.faq.q1', 'Combien de stagiaires formez-vous par session ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s6.faq.a1" data-type="richtext">
              <?= t('s6.faq.a1', 'Nous limitons volontairement les groupes à 2 à 4 personnes par session afin que chaque participant passe un maximum de temps les mains sur la machine sous la supervision directe du formateur.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s6.faq.q2" data-type="text">
              <?= e(t('s6.faq.q2', 'Quelle est la durée habituelle d\'une formation ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s6.faq.a2" data-type="richtext">
              <?= t('s6.faq.a2', 'Un module standard dure de 2 à 3 jours selon le niveau initial. Nous pouvons également organiser des sessions de perfectionnement avancé de 1 jour sur des problématiques ciblées (ex: pliage de tôles très épaisses ou inox miroir).') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s6.faq.q3" data-type="text">
              <?= e(t('s6.faq.q3', 'Intervenez-vous aussi en Tunisie et au Maghreb ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s6.faq.a3" data-type="richtext">
              <?= t('s6.faq.a3', 'Oui, nous animons régulièrement des sessions de formation dans des usines de tôlerie en Tunisie (Grand Tunis, Sousse, Sfax) ainsi qu\'au Maghreb. Les formations peuvent être dispensées en français ou avec explications techniques en arabe pour une compréhension immédiate des opérateurs.') ?>
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
        <h2 class="font-grotesk font-bold text-3xl sm:text-4xl text-np-text mb-5" data-edit="s6.cta.title" data-type="text">
          <?= e(t('s6.cta.title', 'Développez l\'autonomie et la précision de vos régleurs')) ?>
        </h2>
        <p class="text-base text-np-text-muted max-w-2xl mx-auto mb-10 leading-relaxed" data-edit="s6.cta.text" data-type="text">
          <?= e(t('s6.cta.text', 'Investissez dans les compétences terrain de vos équipes pour éliminer les rebuts et sécuriser vos plieuses.')) ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="/contact?type=formation&service=formation" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-xl transition-all duration-200">
            <span>Demander un programme de formation</span>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
          <a href="/contact" class="inline-flex items-center justify-center px-6 py-4 text-sm font-medium text-np-text hover:text-np-accent transition-colors">
            <span>Échanger sur les besoins de vos équipes →</span>
          </a>
        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
