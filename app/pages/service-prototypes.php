<?php
declare(strict_types=1);

$page_key = 'prototypes-developpement-produits';
$seo_data = function_exists('seo') ? seo('prototypes-developpement-produits') : [
    'title' => 'Prototypes métalliques & développement de produits industriels | NOVA PRESTIGE',
    'description' => 'De la 3D au prototype physique : validation du pliage, des outillages et des tolérances avant lancement grande série en tôlerie. 40+ ans d\'expertise.',
    'canonical' => url('/prototypes-developpement-produits')
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
          <span class="text-np-accent font-semibold">Prototypes & développement</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Text Column -->
          <div class="lg:col-span-7">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-5">
              <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
              <span data-edit="s2.hero.badge" data-type="text"><?= e(t('s2.hero.badge', 'Expertise Technique 02 — Prototypage & R&D')) ?></span>
            </div>

            <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-6 leading-tight" data-edit="s2.hero.title" data-type="text">
              <?= e(t('s2.hero.title', 'Prototypes métalliques & validation de produits avant production série')) ?>
            </h1>

            <p class="text-base sm:text-lg text-np-text-muted leading-relaxed mb-8" data-edit="s2.hero.subtitle" data-type="richtext">
              <?= t('s2.hero.subtitle', 'Validez physiquement vos conceptions complexes en tôlerie et mécano-soudure. NOVA PRESTIGE vous accompagne dans la <strong>réalisation de prototypes fiables, l\'essai des outillages spéciaux et la qualification des retraits au pliage</strong>.') ?>
            </p>

            <div class="flex flex-wrap items-center gap-4 mb-10">
              <a href="/contact?type=projet&service=prototypes" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-lg hover:shadow transition-all duration-200">
                <span data-edit="s2.hero.cta_quote" data-type="text"><?= e(t('s2.hero.cta_quote', 'Lancer un prototype test')) ?></span>
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>

              <a href="#prestations" class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-medium text-np-text hover:text-np-accent border border-np-border hover:border-np-accent rounded-xl transition-colors">
                <span>Méthodologie & livrables ↓</span>
              </a>
            </div>

            <!-- Key Proof Points -->
            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-np-border/60">
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-accent" data-edit="s2.stat.val1" data-type="text"><?= e(t('s2.stat.val1', '1 à 10 pcs')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s2.stat.lbl1" data-type="text"><?= e(t('s2.stat.lbl1', 'Séries prototypes')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s2.stat.val2" data-type="text"><?= e(t('s2.stat.val2', '100%')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s2.stat.lbl2" data-type="text"><?= e(t('s2.stat.lbl2', 'Validation cinématique')) ?></span>
              </div>
              <div>
                <span class="block font-grotesk font-bold text-xl sm:text-2xl text-np-text" data-edit="s2.stat.val3" data-type="text"><?= e(t('s2.stat.val3', 'Zéro écart')) ?></span>
                <span class="block text-xs font-mono text-np-text-muted mt-1" data-edit="s2.stat.lbl3" data-type="text"><?= e(t('s2.stat.lbl3', 'Conformité série')) ?></span>
              </div>
            </div>

          </div>

          <!-- Hero Media Column -->
          <div class="lg:col-span-5">
            <?php 
              $hero_img = function_exists('img') ? img('s2.hero.image', '/assets/img/service-prototypes.webp', 'Réalisation et validation de prototypes de tôlerie fine') : ['src' => '/assets/img/service-prototypes.webp', 'alt' => 'Prototypes métalliques']; 
            ?>
            <div class="rounded-2xl overflow-hidden border border-np-border bg-np-surface shadow-2xl relative group">
              <div class="aspect-[4/3] w-full relative overflow-hidden bg-slate-900">
                <img src="<?= e($hero_img['src']) ?>" 
                     alt="<?= e($hero_img['alt']) ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" 
                     loading="eager"
                     decoding="async"
                     data-edit="s2.hero.image" 
                     data-type="image">
                <div class="absolute inset-0 bg-gradient-to-t from-np-surface via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Emblem Top-Left -->
                <div class="absolute top-4 left-4 w-11 h-11 rounded-xl bg-slate-950/80 backdrop-blur-md border border-white/20 flex items-center justify-center text-np-accent shadow-xl z-10 pointer-events-none">
                  <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                  </svg>
                </div>
              </div>

              <div class="p-6 border-t border-np-border/60">
                <div class="flex items-center justify-between text-xs font-mono text-np-text-muted">
                  <span>MATIÈRES TESTÉES :</span>
                  <span class="text-np-accent font-semibold">Acier • Inox • Aluminium • Cuivre</span>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s2.challenges.tag" data-type="text">
            <?= e(t('s2.challenges.tag', 'DÉFIS DU PROTOTYPAGE')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s2.challenges.title" data-type="text">
            <?= e(t('s2.challenges.title', 'Pourquoi figer un modèle 3D sans prototype est un risque industriel majeur')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s2.challenges.intro" data-type="text">
            <?= e(t('s2.challenges.intro', 'Entre la simulation écran et le comportement sous presse plieuse, les écarts de matière peuvent anéantir la rentabilité d\'une série. Le prototype lève toutes les incertitudes.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              01
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s2.chal.t1" data-type="text">
              <?= e(t('s2.chal.t1', 'Retour élastique et écrouissage')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s2.chal.d1" data-type="text">
              <?= e(t('s2.chal.d1', 'Sur les aciers à haute limite élastique (HLE) ou les inox austénitiques, le retour élastique fausse les angles nominaux. Le prototype mesure l\'angle résiduel réel.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              02
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s2.chal.t2" data-type="text">
              <?= e(t('s2.chal.t2', 'Chaîne de cotes et assemblage')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s2.chal.d2" data-type="text">
              <?= e(t('s2.chal.d2', 'La somme des tolérances de découpe et de pliage peut rendre impossible le montage de sous-ensembles mécano-soudés ou de capotages industriels sans réajustement.')) ?>
            </p>
          </div>

          <div class="p-7 rounded-2xl bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300">
            <div class="w-10 h-10 rounded-lg bg-np-accent/10 border border-np-accent/20 flex items-center justify-center text-np-accent font-mono font-bold mb-5">
              03
            </div>
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="s2.chal.t3" data-type="text">
              <?= e(t('s2.chal.t3', 'Coût des outillages prématurés')) ?>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s2.chal.d3" data-type="text">
              <?= e(t('s2.chal.d3', 'Investir dans des outillages spéciaux onéreux (poinçons col de cygne, vés spécifiques) sans avoir testé le passage des ailes de pli expose à des pertes sèches.')) ?>
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s2.deliverables.tag" data-type="text">
            <?= e(t('s2.deliverables.tag', 'SOLUTIONS & LIVRABLES')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4" data-edit="s2.deliverables.title" data-type="text">
            <?= e(t('s2.deliverables.title', 'De l\'éprouvette d\'essai à la pré-série certifiée')) ?>
          </h2>
          <p class="text-base text-np-text-muted leading-relaxed" data-edit="s2.deliverables.intro" data-type="text">
            <?= e(t('s2.deliverables.intro', 'Nous pilotons la fabrication de vos pièces prototypes avec un regard d\'expert outilleur et plieur pour sécuriser l\'ensemble des étapes.')) ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
          
          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s2.item1.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 01</span>
              <span>Prototypes physiques opérationnels & bancs de test</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s2.item1.d" data-type="text">
              <?= e(t('s2.item1.d', 'Fabrication de prototypes unitaires ou en petites grappes (1 à 10 exemplaires) strictement représentatifs des process séries : laser, poinçonnage, pliage et soudage TIG/MIG.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Essais sur nuances réelles de vos fournisseurs matières
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Validation de l\'ergonomie, des fixations et des jeux de montage
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Conception d\'outillages temporaires ou inserts pour tests préliminaires
              </li>
            </ul>
          </div>

          <div class="p-8 rounded-2xl bg-np-surface border border-np-border">
            <h3 class="font-grotesk font-bold text-xl text-np-text mb-4 flex items-center gap-3" data-edit="s2.item2.t" data-type="text">
              <span class="text-np-accent font-mono text-sm">/ 02</span>
              <span>Rapport de retour d\'expérience (RETEX) & ajustement CAO</span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="s2.item2.d" data-type="text">
              <?= e(t('s2.item2.d', 'Chaque essai fait l\'objet de mesures dimensionnelles au marbre et au pied à coulisse optique. Nous réinjectons les cotes réelles mesurées dans le modèle 3D d\'origine.')) ?>
            </p>
            <ul class="space-y-2.5 text-xs font-mono text-np-text-muted">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Relevé des écarts géométriques et ajustement du développé à plat
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Fiche de validation des tonnages et des pressions de serrage
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Feu vert formel pour le lancement de l\'outillage et de la série
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
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="s2.method.tag" data-type="text">
            <?= e(t('s2.method.tag', 'DÉMARCHE QUALIFIÉE')) ?>
          </span>
          <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text mb-4" data-edit="s2.method.title" data-type="text">
            <?= e(t('s2.method.title', 'La route vers la mise en série sans surprise')) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 01</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Revue de conception</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Analyse des tolérances critiques, du sens de laminage et des zones de déformation prévisibles.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 02</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Lancement unitaire</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Découpe et pliage instrumentés avec observation directe des réactions matière au pliage.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 03</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Métrologie & Assemblage</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Contrôle dimensionnel rigoureux, montage des pièces associées et mesure des jeux fonctionnels.
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border relative">
            <span class="font-mono text-xs text-np-accent font-semibold mb-2 block">ÉTAPE 04</span>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Qualification série</h4>
            <p class="text-xs text-np-text-muted leading-relaxed">
              Ajustement des modèles CAO finaux et remise de la fiche de réglage pour les opérateurs d'atelier.
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
        
        <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-np-text text-center mb-12" data-edit="s2.faq.title" data-type="text">
          <?= e(t('s2.faq.title', 'Questions fréquentes — Prototypes & développement')) ?>
        </h2>

        <div class="space-y-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s2.faq.q1" data-type="text">
              <?= e(t('s2.faq.q1', 'Où sont fabriqués les prototypes ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s2.faq.a1" data-type="richtext">
              <?= t('s2.faq.a1', 'Selon vos besoins, nous pouvons soit piloter les essais directement sur vos presses plieuses dans votre usine, soit faire réaliser les pièces par notre réseau de partenaires industriels qualifiés en France ou en Tunisie.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s2.faq.q2" data-type="text">
              <?= e(t('s2.faq.q2', 'Combien de temps faut-il pour valider un prototype métallique ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s2.faq.a2" data-type="richtext">
              <?= t('s2.faq.a2', 'Pour une pièce unitaire en tôle découpée/pliée, le cycle complet (revue, réalisation, contrôle dimensionnel) prend généralement de 3 à 7 jours ouvrés.') ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border">
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2" data-edit="s2.faq.q3" data-type="text">
              <?= e(t('s2.faq.q3', 'Garantissez-vous la confidentialité de nos nouveaux produits ?')) ?>
            </h4>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="s2.faq.a3" data-type="richtext">
              <?= t('s2.faq.a3', 'Absolument. Un accord de confidentialité strict (NDA) est systématiquement signé avant la transmission de tout fichier 3D, plan ou cahier des charges.') ?>
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
        <h2 class="font-grotesk font-bold text-3xl sm:text-4xl text-np-text mb-5" data-edit="s2.cta.title" data-type="text">
          <?= e(t('s2.cta.title', 'Donnez vie à vos prototypes industriels en toute sécurité')) ?>
        </h2>
        <p class="text-base text-np-text-muted max-w-2xl mx-auto mb-10 leading-relaxed" data-edit="s2.cta.text" data-type="text">
          <?= e(t('s2.cta.text', 'Bénéficiez de 40 ans d\'expérience d\'outilleur pour fiabiliser votre produit avant d\'engager des frais de production série.')) ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a href="/contact?type=projet&service=prototypes" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-xl shadow-xl transition-all duration-200">
            <span>Demander une étude de prototype</span>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
          <a href="/contact" class="inline-flex items-center justify-center px-6 py-4 text-sm font-medium text-np-text hover:text-np-accent transition-colors">
            <span>Échanger avec notre expert technique →</span>
          </a>
        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
