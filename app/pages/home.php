<?php
$page_key = 'home';
$seo_data = function_exists('seo') ? seo('home') : [
    'title' => "NOVA PRESTIGE | Bureau d'études, conseil industriel et formation",
    'description' => "Consultant technique senior : étude de faisabilité industrielle, développement de produits métalliques, calepinage de façades, industrialisation et formation en atelier. France, Tunisie, Maghreb.",
    'canonical' => url('/')
];
include __DIR__ . '/../partials/head.php';
?>
<body class="bg-np-bg text-np-text font-inter antialiased selection:bg-np-accent selection:text-white" <?= function_exists('is_admin') && is_admin() ? 'data-admin="1"' : '' ?> id="top">

  <!-- Accessibility Skip link -->
  <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 bg-np-accent text-white px-5 py-2.5 rounded-md shadow-xl z-50 font-medium">Aller au contenu principal</a>

  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main id="main-content">
    
    <!-- ========================================== -->
    <!-- SECTION 1: HERO                            -->
    <!-- ========================================== -->
    <section id="hero" class="relative min-h-[92vh] flex items-center overflow-hidden bg-np-primary" aria-label="Présentation générale">
      
      <!-- Technical Grid Overlay (Animated blueprint lines & dimension marks) -->
      <div class="absolute inset-0 pointer-events-none z-10 opacity-15 overflow-hidden" aria-hidden="true">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <pattern id="hero-grid" width="60" height="60" patternUnits="userSpaceOnUse">
              <path d="M 60 0 L 0 0 0 60" fill="none" stroke="#FFFFFF" stroke-width="0.75" />
              <circle cx="0" cy="0" r="1.5" fill="#C8692E" />
            </pattern>
          </defs>
          <rect width="100%" height="100%" fill="url(#hero-grid)" />
          
          <!-- Animated Dimension / Blueprint Line -->
          <line x1="10%" y1="20%" x2="45%" y2="20%" stroke="#C8692E" stroke-width="1.5" stroke-dasharray="8 4" class="blueprint-dim-line" />
          <line x1="10%" y1="18%" x2="10%" y2="22%" stroke="#C8692E" stroke-width="1.5" />
          <line x1="45%" y1="18%" x2="45%" y2="22%" stroke="#C8692E" stroke-width="1.5" />
          <text x="25%" y="18%" fill="#C8692E" font-family="'JetBrains Mono', monospace" font-size="10" text-anchor="middle">40+ EXP. ANNÉES</text>
        </svg>
      </div>

      <!-- Hero Background Image & Gradient Overlays -->
      <div class="absolute inset-0 z-0">
        <?php 
          $hero_img = function_exists('img') ? img('home.hero.image') : ['src' => '/assets/img/home-hero.webp', 'alt' => 'Façade métallique moderne']; 
        ?>
        <?php if (!empty($hero_img['src']) && file_exists(dirname(__DIR__, 2) . '/public' . $hero_img['src'])): ?>
          <img src="<?= e($hero_img['src']) ?>" 
               alt="<?= e($hero_img['alt']) ?>" 
               class="w-full h-full object-cover object-center opacity-30 transform scale-105 transition-transform duration-1000 ease-out"
               fetchpriority="high" 
               decoding="async"
               data-edit="home.hero.image" 
               data-type="image">
        <?php else: ?>
          <div class="w-full h-full" 
               style="background: radial-gradient(circle at 70% 30%, #1A4070 0%, #12304F 55%, #0A0F16 100%)" 
               data-edit="home.hero.image" 
               data-type="image"></div>
        <?php endif; ?>
        
        <!-- Multi-layer contrast gradients -->
        <div class="absolute inset-0 bg-gradient-to-r from-np-primary via-np-primary/90 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-np-primary via-transparent to-transparent"></div>
      </div>

      <!-- Hero Content -->
      <div class="relative z-20 container mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="max-w-3xl">
          
          <!-- Supertitle with technical indicator -->
          <div class="flex items-center gap-2.5 mb-4">
            <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
            <p class="font-mono text-np-accent text-xs sm:text-sm tracking-widest uppercase font-semibold" 
               data-edit="home.hero.supertitle" 
               data-type="text">
              <?= e(t('home.hero.supertitle')) ?>
            </p>
          </div>
          
          <!-- H1 with Word-Reveal effect -->
          <h1 class="font-grotesk text-white font-bold mb-6 leading-[1.1] tracking-tight" 
              style="font-size: clamp(2.25rem, 4.8vw, 4.25rem)" 
              data-word-reveal 
              data-edit="home.hero.title" 
              data-type="text">
            <?= e(t('home.hero.title')) ?>
          </h1>
          
          <!-- Subtitle -->
          <p class="text-blue-100/90 text-lg sm:text-xl mb-5 leading-relaxed font-normal reveal-fade" 
             data-edit="home.hero.subtitle" 
             data-type="text">
            <?= e(t('home.hero.subtitle')) ?>
          </p>
          
          <!-- Explanatory Text -->
          <p class="text-slate-300 text-sm sm:text-base mb-8 leading-relaxed max-w-2xl reveal-fade" 
             data-edit="home.hero.text" 
             data-type="text">
            <?= e(t('home.hero.text')) ?>
          </p>
          
          <!-- Action Buttons (CTAs) -->
          <div class="flex flex-wrap items-center gap-4 mb-10 reveal-up">
            <a href="/contact?type=projet" 
               class="btn-primary btn-magnetic inline-flex items-center justify-center px-6 py-3.5 rounded-lg bg-np-accent hover:bg-np-accent/90 text-white font-semibold text-sm shadow-lg hover:shadow-np-accent/20 transition-all duration-200">
              <span><?= e(t('home.hero.cta_project', 'Présenter mon projet')) ?></span>
              <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </a>

            <a href="/contact?type=devis" 
               class="btn-secondary inline-flex items-center justify-center px-6 py-3.5 rounded-lg border-2 border-white/80 hover:border-white text-white hover:bg-white hover:text-np-primary font-semibold text-sm transition-all duration-200">
              <span><?= e(t('home.hero.cta_quote', 'Demander un devis')) ?></span>
            </a>

            <a href="/contact" 
               class="btn-text inline-flex items-center text-sm font-mono text-blue-200 hover:text-np-accent transition-colors px-2 py-2">
              <span><?= e(t('home.hero.cta_contact', 'Me contacter →')) ?></span>
            </a>
          </div>
          
          <!-- Badges -->
          <div class="flex flex-wrap gap-2.5 sm:gap-3 reveal-up">
            <span class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/15 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 text-white text-xs sm:text-sm font-mono shadow-sm transition-colors">
              <span class="text-np-accent">✓</span> <?= e(t('home.hero.badge1')) ?>
            </span>
            <span class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/15 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 text-white text-xs sm:text-sm font-mono shadow-sm transition-colors">
              <span class="text-np-accent">✓</span> <?= e(t('home.hero.badge2')) ?>
            </span>
            <span class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/15 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 text-white text-xs sm:text-sm font-mono shadow-sm transition-colors">
              <span class="text-np-accent">✓</span> <?= e(t('home.hero.badge3')) ?>
            </span>
          </div>

        </div>
      </div>
      
      <!-- Scroll Indicator -->
      <a href="#stats" 
         class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 text-white/60 hover:text-np-accent transition-colors p-2"
         aria-label="Faire défiler vers les statistiques">
        <div class="flex flex-col items-center gap-1">
          <span class="text-[10px] font-mono tracking-widest uppercase opacity-75">Scroll</span>
          <svg class="w-5 h-5 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
          </svg>
        </div>
      </a>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 2: STATS                           -->
    <!-- ========================================== -->
    <section id="stats" class="bg-np-surface border-b border-np-border py-12 lg:py-16 relative" aria-label="Chiffres clés">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
          
          <!-- Stat 1 -->
          <div class="stat-card border-l-2 border-np-accent pl-4 sm:pl-6 reveal-up">
            <div class="flex items-baseline gap-1 font-mono text-3xl sm:text-4xl lg:text-5xl font-bold text-np-accent">
              <span class="counter-number" data-count="<?= e(t('home.stats.item1_val', '40')) ?>"><?= e(t('home.stats.item1_val', '40')) ?></span>
              <span><?= e(t('home.stats.item1_suffix', '+')) ?></span>
            </div>
            <p class="text-xs sm:text-sm text-np-text-muted mt-2 font-medium leading-snug">
              <?= e(t('home.stats.item1_label')) ?>
            </p>
          </div>

          <!-- Stat 2 -->
          <div class="stat-card border-l-2 border-np-accent pl-4 sm:pl-6 reveal-up" style="--stagger: 1">
            <div class="flex items-baseline gap-1 font-mono text-3xl sm:text-4xl lg:text-5xl font-bold text-np-accent">
              <span class="counter-number" data-count="<?= e(t('home.stats.item2_val', '6')) ?>"><?= e(t('home.stats.item2_val', '6')) ?></span>
            </div>
            <p class="text-xs sm:text-sm text-np-text-muted mt-2 font-medium leading-snug">
              <?= e(t('home.stats.item2_label')) ?>
            </p>
          </div>

          <!-- Stat 3 -->
          <div class="stat-card border-l-2 border-np-accent pl-4 sm:pl-6 reveal-up" style="--stagger: 2">
            <div class="flex items-baseline gap-1 font-mono text-3xl sm:text-4xl lg:text-5xl font-bold text-np-accent">
              <span class="counter-number" data-count="<?= e(t('home.stats.item3_val', '3')) ?>"><?= e(t('home.stats.item3_val', '3')) ?></span>
            </div>
            <p class="text-xs sm:text-sm text-np-text-muted mt-2 font-medium leading-snug">
              <?= e(t('home.stats.item3_label')) ?>
            </p>
          </div>

          <!-- Stat 4 -->
          <div class="stat-card border-l-2 border-np-accent pl-4 sm:pl-6 reveal-up" style="--stagger: 3">
            <div class="flex items-baseline gap-1 font-mono text-3xl sm:text-4xl lg:text-5xl font-bold text-np-accent">
              <span class="counter-number" data-count="<?= e(t('home.stats.item4_val', '1')) ?>"><?= e(t('home.stats.item4_val', '1')) ?></span>
            </div>
            <p class="text-xs sm:text-sm text-np-text-muted mt-2 font-medium leading-snug">
              <?= e(t('home.stats.item4_label')) ?>
            </p>
          </div>

        </div>
      </div>
    </section>

    <!-- ========================================== -->
    <!-- MARQUEE BANNER                             -->
    <!-- ========================================== -->
    <div class="marquee-container overflow-hidden border-b border-np-border py-4 bg-np-bg/80 select-none" aria-hidden="true">
      <div class="marquee-track flex gap-8 whitespace-nowrap text-sm font-mono tracking-wider uppercase text-np-text-muted">
        <?php for ($m = 0; $m < 4; $m++): ?>
        <span class="hover:text-np-accent transition-colors">Faisabilité</span>
        <span class="text-np-accent">·</span>
        <span class="hover:text-np-accent transition-colors">Prototypes</span>
        <span class="text-np-accent">·</span>
        <span class="hover:text-np-accent transition-colors">Façades Métalliques</span>
        <span class="text-np-accent">·</span>
        <span class="hover:text-np-accent transition-colors">Calepinage</span>
        <span class="text-np-accent">·</span>
        <span class="hover:text-np-accent transition-colors">Industrialisation</span>
        <span class="text-np-accent">·</span>
        <span class="hover:text-np-accent transition-colors">Formation sur site</span>
        <span class="text-np-accent">·</span>
        <?php endfor; ?>
      </div>
    </div>

    <!-- ========================================== -->
    <!-- SECTION 3: EXPERTISES (6 Cards)            -->
    <!-- ========================================== -->
    <section id="expertises" class="py-20 lg:py-28 relative overflow-hidden" aria-labelledby="expertises-heading">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="max-w-3xl mb-14 lg:mb-18">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="home.services.tag" data-type="text">
            <?= e(t('home.services.tag')) ?>
          </span>
          <h2 id="expertises-heading" class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4 leading-tight" data-edit="home.services.title" data-type="text">
            <?= e(t('home.services.title')) ?>
          </h2>
          <p class="text-base sm:text-lg text-np-text-muted leading-relaxed" data-edit="home.services.intro" data-type="text">
            <?= e(t('home.services.intro')) ?>
          </p>
        </div>

        <!-- 6 Cards Grid (2x3) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
          
          <!-- Card 1 -->
          <article class="service-card group rounded-2xl bg-np-surface border border-np-border overflow-hidden hover:border-np-accent hover:shadow-xl transition-all duration-300 flex flex-col justify-between reveal-up" style="--stagger: 0">
            <div>
              <div class="h-48 w-full bg-slate-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-np-primary to-slate-800 opacity-90 group-hover:scale-105 transition-transform duration-500"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6 text-white/20 group-hover:text-np-accent/40 transition-colors">
                  <svg class="w-16 h-16 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                </div>
                <span class="absolute top-4 left-4 font-mono text-xs text-white/80 bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded">01</span>
              </div>
              <div class="p-6 sm:p-7">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text group-hover:text-np-accent transition-colors mb-2.5" data-edit="home.services.s1_title" data-type="text">
                  <?= e(t('home.services.s1_title')) ?>
                </h3>
                <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.services.s1_text" data-type="text">
                  <?= e(t('home.services.s1_text')) ?>
                </p>
              </div>
            </div>
            <div class="px-6 pb-6 pt-0">
              <a href="/bureau-etudes-faisabilite" class="inline-flex items-center text-xs font-mono font-semibold text-np-accent group-hover:text-np-accent/80 transition-colors">
                <span>En savoir plus</span>
                <span class="ml-1 transition-transform group-hover:translate-x-1">→</span>
              </a>
            </div>
          </article>

          <!-- Card 2 -->
          <article class="service-card group rounded-2xl bg-np-surface border border-np-border overflow-hidden hover:border-np-accent hover:shadow-xl transition-all duration-300 flex flex-col justify-between reveal-up" style="--stagger: 1">
            <div>
              <div class="h-48 w-full bg-slate-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-np-primary to-slate-800 opacity-90 group-hover:scale-105 transition-transform duration-500"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6 text-white/20 group-hover:text-np-accent/40 transition-colors">
                  <svg class="w-16 h-16 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                  </svg>
                </div>
                <span class="absolute top-4 left-4 font-mono text-xs text-white/80 bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded">02</span>
              </div>
              <div class="p-6 sm:p-7">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text group-hover:text-np-accent transition-colors mb-2.5" data-edit="home.services.s2_title" data-type="text">
                  <?= e(t('home.services.s2_title')) ?>
                </h3>
                <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.services.s2_text" data-type="text">
                  <?= e(t('home.services.s2_text')) ?>
                </p>
              </div>
            </div>
            <div class="px-6 pb-6 pt-0">
              <a href="/prototypes-developpement-produits" class="inline-flex items-center text-xs font-mono font-semibold text-np-accent group-hover:text-np-accent/80 transition-colors">
                <span>En savoir plus</span>
                <span class="ml-1 transition-transform group-hover:translate-x-1">→</span>
              </a>
            </div>
          </article>

          <!-- Card 3 -->
          <article class="service-card group rounded-2xl bg-np-surface border border-np-border overflow-hidden hover:border-np-accent hover:shadow-xl transition-all duration-300 flex flex-col justify-between reveal-up" style="--stagger: 2">
            <div>
              <div class="h-48 w-full bg-slate-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-np-primary to-slate-800 opacity-90 group-hover:scale-105 transition-transform duration-500"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6 text-white/20 group-hover:text-np-accent/40 transition-colors">
                  <svg class="w-16 h-16 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                  </svg>
                </div>
                <span class="absolute top-4 left-4 font-mono text-xs text-white/80 bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded">03</span>
              </div>
              <div class="p-6 sm:p-7">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text group-hover:text-np-accent transition-colors mb-2.5" data-edit="home.services.s3_title" data-type="text">
                  <?= e(t('home.services.s3_title')) ?>
                </h3>
                <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.services.s3_text" data-type="text">
                  <?= e(t('home.services.s3_text')) ?>
                </p>
              </div>
            </div>
            <div class="px-6 pb-6 pt-0">
              <a href="/facades-metalliques-bardage-calepinage" class="inline-flex items-center text-xs font-mono font-semibold text-np-accent group-hover:text-np-accent/80 transition-colors">
                <span>En savoir plus</span>
                <span class="ml-1 transition-transform group-hover:translate-x-1">→</span>
              </a>
            </div>
          </article>

          <!-- Card 4 -->
          <article class="service-card group rounded-2xl bg-np-surface border border-np-border overflow-hidden hover:border-np-accent hover:shadow-xl transition-all duration-300 flex flex-col justify-between reveal-up" style="--stagger: 3">
            <div>
              <div class="h-48 w-full bg-slate-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-np-primary to-slate-800 opacity-90 group-hover:scale-105 transition-transform duration-500"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6 text-white/20 group-hover:text-np-accent/40 transition-colors">
                  <svg class="w-16 h-16 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
                <span class="absolute top-4 left-4 font-mono text-xs text-white/80 bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded">04</span>
              </div>
              <div class="p-6 sm:p-7">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text group-hover:text-np-accent transition-colors mb-2.5" data-edit="home.services.s4_title" data-type="text">
                  <?= e(t('home.services.s4_title')) ?>
                </h3>
                <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.services.s4_text" data-type="text">
                  <?= e(t('home.services.s4_text')) ?>
                </p>
              </div>
            </div>
            <div class="px-6 pb-6 pt-0">
              <a href="/methodes-industrialisation" class="inline-flex items-center text-xs font-mono font-semibold text-np-accent group-hover:text-np-accent/80 transition-colors">
                <span>En savoir plus</span>
                <span class="ml-1 transition-transform group-hover:translate-x-1">→</span>
              </a>
            </div>
          </article>

          <!-- Card 5 -->
          <article class="service-card group rounded-2xl bg-np-surface border border-np-border overflow-hidden hover:border-np-accent hover:shadow-xl transition-all duration-300 flex flex-col justify-between reveal-up" style="--stagger: 4">
            <div>
              <div class="h-48 w-full bg-slate-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-np-primary to-slate-800 opacity-90 group-hover:scale-105 transition-transform duration-500"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6 text-white/20 group-hover:text-np-accent/40 transition-colors">
                  <svg class="w-16 h-16 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                  </svg>
                </div>
                <span class="absolute top-4 left-4 font-mono text-xs text-white/80 bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded">05</span>
              </div>
              <div class="p-6 sm:p-7">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text group-hover:text-np-accent transition-colors mb-2.5" data-edit="home.services.s5_title" data-type="text">
                  <?= e(t('home.services.s5_title')) ?>
                </h3>
                <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.services.s5_text" data-type="text">
                  <?= e(t('home.services.s5_text')) ?>
                </p>
              </div>
            </div>
            <div class="px-6 pb-6 pt-0">
              <a href="/conseil-industriel-equipements" class="inline-flex items-center text-xs font-mono font-semibold text-np-accent group-hover:text-np-accent/80 transition-colors">
                <span>En savoir plus</span>
                <span class="ml-1 transition-transform group-hover:translate-x-1">→</span>
              </a>
            </div>
          </article>

          <!-- Card 6 -->
          <article class="service-card group rounded-2xl bg-np-surface border border-np-border overflow-hidden hover:border-np-accent hover:shadow-xl transition-all duration-300 flex flex-col justify-between reveal-up" style="--stagger: 5">
            <div>
              <div class="h-48 w-full bg-slate-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-np-primary to-slate-800 opacity-90 group-hover:scale-105 transition-transform duration-500"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6 text-white/20 group-hover:text-np-accent/40 transition-colors">
                  <svg class="w-16 h-16 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                  </svg>
                </div>
                <span class="absolute top-4 left-4 font-mono text-xs text-white/80 bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded">06</span>
              </div>
              <div class="p-6 sm:p-7">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text group-hover:text-np-accent transition-colors mb-2.5" data-edit="home.services.s6_title" data-type="text">
                  <?= e(t('home.services.s6_title')) ?>
                </h3>
                <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.services.s6_text" data-type="text">
                  <?= e(t('home.services.s6_text')) ?>
                </p>
              </div>
            </div>
            <div class="px-6 pb-6 pt-0">
              <a href="/formation-technique-atelier" class="inline-flex items-center text-xs font-mono font-semibold text-np-accent group-hover:text-np-accent/80 transition-colors">
                <span>En savoir plus</span>
                <span class="ml-1 transition-transform group-hover:translate-x-1">→</span>
              </a>
            </div>
          </article>

        </div>
      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 4: PROCESS (5 Steps Timeline)      -->
    <!-- ========================================== -->
    <section id="methode" class="py-20 lg:py-28 bg-np-surface/60 border-y border-np-border relative" aria-labelledby="process-heading">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="max-w-3xl mb-16 lg:mb-20">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="home.process.tag" data-type="text">
            <?= e(t('home.process.tag')) ?>
          </span>
          <h2 id="process-heading" class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4 leading-tight" data-edit="home.process.title" data-type="text">
            <?= e(t('home.process.title')) ?>
          </h2>
        </div>

        <!-- 5-Step Process Timeline -->
        <div class="relative max-w-4xl mx-auto">
          <!-- Animated vertical connecting line -->
          <div class="absolute left-6 sm:left-8 top-4 bottom-4 w-0.5 bg-np-border">
            <div id="process-line-fill" class="w-full bg-np-accent h-0 transition-all duration-300"></div>
          </div>

          <div class="space-y-12 sm:space-y-14 relative z-10">
            
            <!-- Step 1 -->
            <div class="flex items-start gap-6 sm:gap-10 group reveal-up">
              <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-np-surface border-2 border-np-accent text-np-accent flex items-center justify-center font-mono font-bold text-sm sm:text-lg flex-shrink-0 shadow-md group-hover:bg-np-accent group-hover:text-white transition-all duration-300">
                01
              </div>
              <div class="pt-2">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text mb-2" data-edit="home.process.step1_title" data-type="text">
                  <?= e(t('home.process.step1_title')) ?>
                </h3>
                <p class="text-sm sm:text-base text-np-text-muted leading-relaxed" data-edit="home.process.step1_text" data-type="text">
                  <?= e(t('home.process.step1_text')) ?>
                </p>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="flex items-start gap-6 sm:gap-10 group reveal-up" style="--stagger: 1">
              <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-np-surface border-2 border-np-accent text-np-accent flex items-center justify-center font-mono font-bold text-sm sm:text-lg flex-shrink-0 shadow-md group-hover:bg-np-accent group-hover:text-white transition-all duration-300">
                02
              </div>
              <div class="pt-2">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text mb-2" data-edit="home.process.step2_title" data-type="text">
                  <?= e(t('home.process.step2_title')) ?>
                </h3>
                <p class="text-sm sm:text-base text-np-text-muted leading-relaxed" data-edit="home.process.step2_text" data-type="text">
                  <?= e(t('home.process.step2_text')) ?>
                </p>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="flex items-start gap-6 sm:gap-10 group reveal-up" style="--stagger: 2">
              <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-np-surface border-2 border-np-accent text-np-accent flex items-center justify-center font-mono font-bold text-sm sm:text-lg flex-shrink-0 shadow-md group-hover:bg-np-accent group-hover:text-white transition-all duration-300">
                03
              </div>
              <div class="pt-2">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text mb-2" data-edit="home.process.step3_title" data-type="text">
                  <?= e(t('home.process.step3_title')) ?>
                </h3>
                <p class="text-sm sm:text-base text-np-text-muted leading-relaxed" data-edit="home.process.step3_text" data-type="text">
                  <?= e(t('home.process.step3_text')) ?>
                </p>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="flex items-start gap-6 sm:gap-10 group reveal-up" style="--stagger: 3">
              <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-np-surface border-2 border-np-accent text-np-accent flex items-center justify-center font-mono font-bold text-sm sm:text-lg flex-shrink-0 shadow-md group-hover:bg-np-accent group-hover:text-white transition-all duration-300">
                04
              </div>
              <div class="pt-2">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text mb-2" data-edit="home.process.step4_title" data-type="text">
                  <?= e(t('home.process.step4_title')) ?>
                </h3>
                <p class="text-sm sm:text-base text-np-text-muted leading-relaxed" data-edit="home.process.step4_text" data-type="text">
                  <?= e(t('home.process.step4_text')) ?>
                </p>
              </div>
            </div>

            <!-- Step 5 -->
            <div class="flex items-start gap-6 sm:gap-10 group reveal-up" style="--stagger: 4">
              <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-np-surface border-2 border-np-accent text-np-accent flex items-center justify-center font-mono font-bold text-sm sm:text-lg flex-shrink-0 shadow-md group-hover:bg-np-accent group-hover:text-white transition-all duration-300">
                05
              </div>
              <div class="pt-2">
                <h3 class="font-grotesk font-bold text-lg sm:text-xl text-np-text mb-2" data-edit="home.process.step5_title" data-type="text">
                  <?= e(t('home.process.step5_title')) ?>
                </h3>
                <p class="text-sm sm:text-base text-np-text-muted leading-relaxed" data-edit="home.process.step5_text" data-type="text">
                  <?= e(t('home.process.step5_text')) ?>
                </p>
              </div>
            </div>

          </div>

          <!-- Editorial Guardrail Note -->
          <div class="mt-14 p-4 rounded-xl bg-np-bg border border-np-border flex items-start gap-3 text-xs sm:text-sm text-np-text-muted">
            <span class="text-np-accent font-mono text-base leading-none">ℹ</span>
            <p data-edit="home.process.note" data-type="text">
              <?= e(t('home.process.note')) ?>
            </p>
          </div>
        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 5: AUDIENCE (Vous êtes...)         -->
    <!-- ========================================== -->
    <section id="profils" class="py-20 lg:py-28 relative" aria-labelledby="audience-heading">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-3xl mb-14 lg:mb-18">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="home.audience.tag" data-type="text">
            <?= e(t('home.audience.tag')) ?>
          </span>
          <h2 id="audience-heading" class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4 leading-tight" data-edit="home.audience.title" data-type="text">
            <?= e(t('home.audience.title')) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
          
          <!-- Card 1 -->
          <div class="rounded-2xl p-6 sm:p-8 bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300 flex flex-col justify-between reveal-up" style="--stagger: 0">
            <div>
              <div class="w-10 h-10 rounded-lg bg-np-primary/10 dark:bg-np-primary/30 text-np-accent flex items-center justify-center mb-6">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
              </div>
              <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="home.audience.card1_role" data-type="text">
                <?= e(t('home.audience.card1_role')) ?>
              </h3>
              <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="home.audience.card1_text" data-type="text">
                <?= e(t('home.audience.card1_text')) ?>
              </p>
            </div>
            <a href="/facades-metalliques-bardage-calepinage" class="text-xs font-mono font-semibold text-np-accent hover:text-np-accent/80 flex items-center gap-1 group">
              <span>Solutions façades & bardage</span>
              <span class="transition-transform group-hover:translate-x-1">→</span>
            </a>
          </div>

          <!-- Card 2 -->
          <div class="rounded-2xl p-6 sm:p-8 bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300 flex flex-col justify-between reveal-up" style="--stagger: 1">
            <div>
              <div class="w-10 h-10 rounded-lg bg-np-primary/10 dark:bg-np-primary/30 text-np-accent flex items-center justify-center mb-6">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="home.audience.card2_role" data-type="text">
                <?= e(t('home.audience.card2_role')) ?>
              </h3>
              <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="home.audience.card2_text" data-type="text">
                <?= e(t('home.audience.card2_text')) ?>
              </p>
            </div>
            <a href="/methodes-industrialisation" class="text-xs font-mono font-semibold text-np-accent hover:text-np-accent/80 flex items-center gap-1 group">
              <span>Optimisation des méthodes</span>
              <span class="transition-transform group-hover:translate-x-1">→</span>
            </a>
          </div>

          <!-- Card 3 -->
          <div class="rounded-2xl p-6 sm:p-8 bg-np-surface border border-np-border hover:border-np-accent transition-all duration-300 flex flex-col justify-between reveal-up" style="--stagger: 2">
            <div>
              <div class="w-10 h-10 rounded-lg bg-np-primary/10 dark:bg-np-primary/30 text-np-accent flex items-center justify-center mb-6">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
              </div>
              <h3 class="font-grotesk font-bold text-lg text-np-text mb-3" data-edit="home.audience.card3_role" data-type="text">
                <?= e(t('home.audience.card3_role')) ?>
              </h3>
              <p class="text-sm text-np-text-muted leading-relaxed mb-6" data-edit="home.audience.card3_text" data-type="text">
                <?= e(t('home.audience.card3_text')) ?>
              </p>
            </div>
            <a href="/bureau-etudes-faisabilite" class="text-xs font-mono font-semibold text-np-accent hover:text-np-accent/80 flex items-center gap-1 group">
              <span>Études de faisabilité amont</span>
              <span class="transition-transform group-hover:translate-x-1">→</span>
            </a>
          </div>

        </div>
      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 6: WHY (Engagements)               -->
    <!-- ========================================== -->
    <section id="engagements" class="py-20 lg:py-28 bg-np-surface/40 border-y border-np-border" aria-labelledby="why-heading">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-3xl mb-14 lg:mb-18">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="home.why.tag" data-type="text">
            <?= e(t('home.why.tag')) ?>
          </span>
          <h2 id="why-heading" class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4 leading-tight" data-edit="home.why.title" data-type="text">
            <?= e(t('home.why.title')) ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
          
          <!-- Point 1 -->
          <div class="flex items-start gap-4 sm:gap-5 reveal-left">
            <div class="w-12 h-12 rounded-xl bg-np-accent/10 border border-np-accent/30 text-np-accent flex items-center justify-center flex-shrink-0">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <div>
              <h3 class="font-grotesk font-bold text-lg text-np-text mb-2" data-edit="home.why.item1_title" data-type="text">
                <?= e(t('home.why.item1_title')) ?>
              </h3>
              <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.why.item1_text" data-type="text">
                <?= e(t('home.why.item1_text')) ?>
              </p>
            </div>
          </div>

          <!-- Point 2 -->
          <div class="flex items-start gap-4 sm:gap-5 reveal-right">
            <div class="w-12 h-12 rounded-xl bg-np-accent/10 border border-np-accent/30 text-np-accent flex items-center justify-center flex-shrink-0">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <div>
              <h3 class="font-grotesk font-bold text-lg text-np-text mb-2" data-edit="home.why.item2_title" data-type="text">
                <?= e(t('home.why.item2_title')) ?>
              </h3>
              <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.why.item2_text" data-type="text">
                <?= e(t('home.why.item2_text')) ?>
              </p>
            </div>
          </div>

          <!-- Point 3 -->
          <div class="flex items-start gap-4 sm:gap-5 reveal-left">
            <div class="w-12 h-12 rounded-xl bg-np-accent/10 border border-np-accent/30 text-np-accent flex items-center justify-center flex-shrink-0">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
            <div>
              <h3 class="font-grotesk font-bold text-lg text-np-text mb-2" data-edit="home.why.item3_title" data-type="text">
                <?= e(t('home.why.item3_title')) ?>
              </h3>
              <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.why.item3_text" data-type="text">
                <?= e(t('home.why.item3_text')) ?>
              </p>
            </div>
          </div>

          <!-- Point 4 -->
          <div class="flex items-start gap-4 sm:gap-5 reveal-right">
            <div class="w-12 h-12 rounded-xl bg-np-accent/10 border border-np-accent/30 text-np-accent flex items-center justify-center flex-shrink-0">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
            </div>
            <div>
              <h3 class="font-grotesk font-bold text-lg text-np-text mb-2" data-edit="home.why.item4_title" data-type="text">
                <?= e(t('home.why.item4_title')) ?>
              </h3>
              <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.why.item4_text" data-type="text">
                <?= e(t('home.why.item4_text')) ?>
              </p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 7: FOCUS FORMATION (Full-width)    -->
    <!-- ========================================== -->
    <section id="formation" class="py-20 lg:py-28 bg-np-primary text-white relative overflow-hidden" aria-labelledby="training-heading">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Image (5 cols) -->
          <div class="lg:col-span-5 reveal-left">
            <div class="rounded-2xl overflow-hidden border border-white/10 shadow-2xl relative bg-slate-900 group">
              <?php 
                $train_img = function_exists('img') ? img('home.training.image') : ['src' => '/assets/img/service-formation.webp', 'alt' => 'Formation en atelier'];
              ?>
              <?php if (!empty($train_img['src']) && file_exists(dirname(__DIR__, 2) . '/public' . $train_img['src'])): ?>
                <img src="<?= e($train_img['src']) ?>" 
                     alt="<?= e($train_img['alt']) ?>" 
                     class="w-full h-80 sm:h-96 object-cover object-center group-hover:scale-105 transition-transform duration-500" 
                     loading="lazy" 
                     decoding="async"
                     data-edit="home.training.image" 
                     data-type="image">
              <?php else: ?>
                <div class="w-full h-80 sm:h-96 flex flex-col items-center justify-center p-8 bg-gradient-to-tr from-slate-900 via-np-primary to-slate-800 text-center" data-edit="home.training.image" data-type="image">
                  <svg class="w-16 h-16 text-np-accent mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                  </svg>
                  <p class="font-grotesk font-semibold text-lg text-white">Formation Pratique en Atelier</p>
                  <p class="text-xs text-slate-300 mt-2 font-mono">Sur vos presses plieuses et équipements</p>
                </div>
              <?php endif; ?>
              <div class="absolute inset-0 bg-gradient-to-t from-np-primary/80 via-transparent to-transparent pointer-events-none"></div>
            </div>
          </div>

          <!-- Text & Bullets (7 cols) -->
          <div class="lg:col-span-7 reveal-right">
            <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="home.training.tag" data-type="text">
              <?= e(t('home.training.tag')) ?>
            </span>
            <h2 id="training-heading" class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-white mb-6 leading-tight" data-edit="home.training.title" data-type="text">
              <?= e(t('home.training.title')) ?>
            </h2>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-8" data-edit="home.training.text" data-type="text">
              <?= e(t('home.training.text')) ?>
            </p>

            <!-- Themes Bullet List -->
            <div class="mb-10">
              <h4 class="text-xs font-mono font-semibold uppercase tracking-wider text-np-accent mb-4">Thèmes d'intervention personnalisables :</h4>
              <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-slate-200 font-mono">
                <li class="flex items-center gap-2.5">
                  <span class="text-np-accent font-bold">✓</span>
                  <span><?= e(t('home.training.theme1')) ?></span>
                </li>
                <li class="flex items-center gap-2.5">
                  <span class="text-np-accent font-bold">✓</span>
                  <span><?= e(t('home.training.theme2')) ?></span>
                </li>
                <li class="flex items-center gap-2.5">
                  <span class="text-np-accent font-bold">✓</span>
                  <span><?= e(t('home.training.theme3')) ?></span>
                </li>
                <li class="flex items-center gap-2.5">
                  <span class="text-np-accent font-bold">✓</span>
                  <span><?= e(t('home.training.theme4')) ?></span>
                </li>
                <li class="flex items-center gap-2.5 sm:col-span-2">
                  <span class="text-np-accent font-bold">✓</span>
                  <span><?= e(t('home.training.theme5')) ?></span>
                </li>
              </ul>
            </div>

            <!-- CTA -->
            <div>
              <a href="/contact?type=projet&service=formation" class="inline-flex items-center justify-center px-6 py-3.5 rounded-lg bg-np-accent hover:bg-np-accent/90 text-white font-semibold text-sm transition-all shadow-lg group">
                <span data-edit="home.training.cta" data-type="text"><?= e(t('home.training.cta', "Discuter d'un programme")) ?></span>
                <span class="ml-2 transition-transform group-hover:translate-x-1">→</span>
              </a>
            </div>

          </div>

        </div>
      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 8: ZONES D'INTERVENTION            -->
    <!-- ========================================== -->
    <section id="zones" class="py-20 lg:py-28 relative" aria-labelledby="zones-heading">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-3xl mb-14 lg:mb-18">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="home.zones.tag" data-type="text">
            <?= e(t('home.zones.tag')) ?>
          </span>
          <h2 id="zones-heading" class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4 leading-tight" data-edit="home.zones.title" data-type="text">
            <?= e(t('home.zones.title')) ?>
          </h2>
          <p class="text-base sm:text-lg text-np-text-muted leading-relaxed" data-edit="home.zones.text" data-type="text">
            <?= e(t('home.zones.text')) ?>
          </p>
        </div>

        <!-- Stylized Map / Vector graphic with 3 Pulsing Markers -->
        <div class="rounded-2xl bg-np-surface border border-np-border overflow-hidden p-6 sm:p-10 mb-12 shadow-sm relative">
          <div class="aspect-[16/8] sm:aspect-[16/7] w-full bg-slate-900 rounded-xl relative overflow-hidden flex items-center justify-center">
            
            <!-- Map background image or vector grid -->
            <?php 
              $zones_img = function_exists('img') ? img('home.zones.image') : ['src' => '/assets/img/home-zones.webp', 'alt' => 'Carte des zones d\'intervention'];
            ?>
            <?php if (!empty($zones_img['src']) && file_exists(dirname(__DIR__, 2) . '/public' . $zones_img['src'])): ?>
              <img src="<?= e($zones_img['src']) ?>" 
                   alt="<?= e($zones_img['alt']) ?>" 
                   class="w-full h-full object-cover opacity-60" 
                   loading="lazy"
                   data-edit="home.zones.image" 
                   data-type="image">
            <?php else: ?>
              <div class="absolute inset-0 bg-gradient-to-b from-[#0B1A2B] via-[#12304F] to-[#0A0F16]" data-edit="home.zones.image" data-type="image"></div>
              <!-- Abstract Continental Contours -->
              <svg class="absolute inset-0 w-full h-full opacity-30" viewBox="0 0 800 400" fill="none" stroke="#6FA3D8" stroke-width="1.2">
                <!-- France outline approximation -->
                <path d="M 390 90 L 430 95 L 450 140 L 430 180 L 390 190 L 360 150 Z" />
                <!-- Maghreb / North Africa coastline approximation -->
                <path d="M 280 230 Q 380 220 460 230 L 480 270 L 460 300 Q 360 280 260 290 Z" />
                <!-- Tunisia detail -->
                <path d="M 450 230 L 470 240 L 465 280 L 445 270 Z" />
              </svg>
            <?php endif; ?>

            <!-- 3 Pulsing Markers (France, Tunisia, Maghreb) -->
            <!-- Marker 1: France -->
            <div class="absolute top-[32%] left-[49%] -translate-x-1/2 -translate-y-1/2 flex flex-col items-center group cursor-pointer" title="France">
              <span class="relative flex h-5 w-5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-np-accent opacity-75"></span>
                <span class="relative inline-flex rounded-full h-5 w-5 bg-np-accent border-2 border-white"></span>
              </span>
              <span class="mt-1.5 px-2 py-0.5 rounded bg-black/75 backdrop-blur-sm text-[10px] font-mono text-white tracking-wider uppercase">France</span>
            </div>

            <!-- Marker 2: Tunisie -->
            <div class="absolute top-[64%] left-[58%] -translate-x-1/2 -translate-y-1/2 flex flex-col items-center group cursor-pointer" title="Tunisie">
              <span class="relative flex h-5 w-5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-np-accent opacity-75"></span>
                <span class="relative inline-flex rounded-full h-5 w-5 bg-np-accent border-2 border-white"></span>
              </span>
              <span class="mt-1.5 px-2 py-0.5 rounded bg-black/75 backdrop-blur-sm text-[10px] font-mono text-white tracking-wider uppercase">Tunisie</span>
            </div>

            <!-- Marker 3: Maghreb -->
            <div class="absolute top-[68%] left-[42%] -translate-x-1/2 -translate-y-1/2 flex flex-col items-center group cursor-pointer" title="Maghreb">
              <span class="relative flex h-5 w-5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-np-accent opacity-75"></span>
                <span class="relative inline-flex rounded-full h-5 w-5 bg-np-accent border-2 border-white"></span>
              </span>
              <span class="mt-1.5 px-2 py-0.5 rounded bg-black/75 backdrop-blur-sm text-[10px] font-mono text-white tracking-wider uppercase">Maghreb</span>
            </div>

          </div>
        </div>

        <!-- 3 Cards below map -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          
          <div class="p-6 rounded-xl bg-np-surface border border-np-border reveal-up" style="--stagger: 0">
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-2 flex items-center gap-2" data-edit="home.zones.france_title" data-type="text">
              <span class="w-2.5 h-2.5 rounded-full bg-np-accent"></span>
              <span><?= e(t('home.zones.france_title')) ?></span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.zones.france_text" data-type="text">
              <?= e(t('home.zones.france_text')) ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border reveal-up" style="--stagger: 1">
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-2 flex items-center gap-2" data-edit="home.zones.tunisie_title" data-type="text">
              <span class="w-2.5 h-2.5 rounded-full bg-np-accent"></span>
              <span><?= e(t('home.zones.tunisie_title')) ?></span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.zones.tunisie_text" data-type="text">
              <?= e(t('home.zones.tunisie_text')) ?>
            </p>
          </div>

          <div class="p-6 rounded-xl bg-np-surface border border-np-border reveal-up" style="--stagger: 2">
            <h3 class="font-grotesk font-bold text-lg text-np-text mb-2 flex items-center gap-2" data-edit="home.zones.maghreb_title" data-type="text">
              <span class="w-2.5 h-2.5 rounded-full bg-np-accent"></span>
              <span><?= e(t('home.zones.maghreb_title')) ?></span>
            </h3>
            <p class="text-sm text-np-text-muted leading-relaxed" data-edit="home.zones.maghreb_text" data-type="text">
              <?= e(t('home.zones.maghreb_text')) ?>
            </p>
          </div>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 9: FAQ (Accordion)                 -->
    <!-- ========================================== -->
    <section id="faq" class="py-20 lg:py-28 bg-np-surface/40 border-t border-np-border" aria-labelledby="faq-heading">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-3xl mb-14 lg:mb-18">
          <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-2" data-edit="home.faq.tag" data-type="text">
            <?= e(t('home.faq.tag')) ?>
          </span>
          <h2 id="faq-heading" class="font-grotesk font-bold text-2xl sm:text-3xl lg:text-4xl text-np-text mb-4 leading-tight" data-edit="home.faq.title" data-type="text">
            <?= e(t('home.faq.title')) ?>
          </h2>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
          
          <!-- Item 1 -->
          <details class="group bg-np-surface rounded-xl border border-np-border p-5 transition-all duration-200 open:border-np-accent">
            <summary class="flex items-center justify-between font-grotesk font-semibold text-base sm:text-lg text-np-text cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent rounded">
              <span data-edit="home.faq.q1" data-type="text"><?= e(t('home.faq.q1')) ?></span>
              <span class="ml-4 transition-transform duration-200 group-open:rotate-180 text-np-accent flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
              </span>
            </summary>
            <div class="mt-4 pt-3 border-t border-np-border text-sm text-np-text-muted leading-relaxed" data-edit="home.faq.a1" data-type="text">
              <?= e(t('home.faq.a1')) ?>
            </div>
          </details>

          <!-- Item 2 -->
          <details class="group bg-np-surface rounded-xl border border-np-border p-5 transition-all duration-200 open:border-np-accent">
            <summary class="flex items-center justify-between font-grotesk font-semibold text-base sm:text-lg text-np-text cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent rounded">
              <span data-edit="home.faq.q2" data-type="text"><?= e(t('home.faq.q2')) ?></span>
              <span class="ml-4 transition-transform duration-200 group-open:rotate-180 text-np-accent flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
              </span>
            </summary>
            <div class="mt-4 pt-3 border-t border-np-border text-sm text-np-text-muted leading-relaxed" data-edit="home.faq.a2" data-type="text">
              <?= e(t('home.faq.a2')) ?>
            </div>
          </details>

          <!-- Item 3 -->
          <details class="group bg-np-surface rounded-xl border border-np-border p-5 transition-all duration-200 open:border-np-accent">
            <summary class="flex items-center justify-between font-grotesk font-semibold text-base sm:text-lg text-np-text cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent rounded">
              <span data-edit="home.faq.q3" data-type="text"><?= e(t('home.faq.q3')) ?></span>
              <span class="ml-4 transition-transform duration-200 group-open:rotate-180 text-np-accent flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
              </span>
            </summary>
            <div class="mt-4 pt-3 border-t border-np-border text-sm text-np-text-muted leading-relaxed" data-edit="home.faq.a3" data-type="text">
              <?= e(t('home.faq.a3')) ?>
            </div>
          </details>

          <!-- Item 4 -->
          <details class="group bg-np-surface rounded-xl border border-np-border p-5 transition-all duration-200 open:border-np-accent">
            <summary class="flex items-center justify-between font-grotesk font-semibold text-base sm:text-lg text-np-text cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent rounded">
              <span data-edit="home.faq.q4" data-type="text"><?= e(t('home.faq.q4')) ?></span>
              <span class="ml-4 transition-transform duration-200 group-open:rotate-180 text-np-accent flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
              </span>
            </summary>
            <div class="mt-4 pt-3 border-t border-np-border text-sm text-np-text-muted leading-relaxed" data-edit="home.faq.a4" data-type="text">
              <?= e(t('home.faq.a4')) ?>
            </div>
          </details>

          <!-- Item 5 -->
          <details class="group bg-np-surface rounded-xl border border-np-border p-5 transition-all duration-200 open:border-np-accent">
            <summary class="flex items-center justify-between font-grotesk font-semibold text-base sm:text-lg text-np-text cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent rounded">
              <span data-edit="home.faq.q5" data-type="text"><?= e(t('home.faq.q5')) ?></span>
              <span class="ml-4 transition-transform duration-200 group-open:rotate-180 text-np-accent flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
              </span>
            </summary>
            <div class="mt-4 pt-3 border-t border-np-border text-sm text-np-text-muted leading-relaxed" data-edit="home.faq.a5" data-type="text">
              <?= e(t('home.faq.a5')) ?>
            </div>
          </details>

        </div>

      </div>
    </section>

    <!-- ========================================== -->
    <!-- SECTION 10: CTA FINAL + MINI FORM          -->
    <!-- ========================================== -->
    <section id="cta-section" class="py-20 lg:py-28 bg-np-primary text-white relative overflow-hidden" aria-labelledby="cta-heading">
      
      <!-- Blueprint Grid Overlay -->
      <div class="absolute inset-0 opacity-10 pointer-events-none" aria-hidden="true">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <pattern id="cta-grid" width="40" height="40" patternUnits="userSpaceOnUse">
              <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#FFFFFF" stroke-width="0.75" />
            </pattern>
          </defs>
          <rect width="100%" height="100%" fill="url(#cta-grid)" />
        </svg>
      </div>

      <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          <!-- Left Text (6 cols) -->
          <div class="lg:col-span-6">
            <span class="font-mono text-xs uppercase tracking-widest text-np-accent font-semibold block mb-3">08 — CONTACT DIRECT</span>
            <h2 id="cta-heading" class="font-grotesk font-bold text-3xl sm:text-4xl lg:text-5xl text-white mb-6 leading-tight" data-edit="home.cta.title" data-type="text">
              <?= e(t('home.cta.title')) ?>
            </h2>
            <p class="text-blue-100/90 text-base sm:text-lg leading-relaxed mb-8 max-w-lg" data-edit="home.cta.text" data-type="text">
              <?= e(t('home.cta.text')) ?>
            </p>
            
            <div class="space-y-4 pt-4 border-t border-white/10 text-sm text-slate-300 font-mono">
              <div class="flex items-center gap-3">
                <span class="text-np-accent font-bold">✓</span>
                <span>Réponse directe sous 48 heures ouvrées</span>
              </div>
              <div class="flex items-center gap-3">
                <span class="text-np-accent font-bold">✓</span>
                <span>Étude confidentielle de vos documents et plans</span>
              </div>
              <div class="flex items-center gap-3">
                <span class="text-np-accent font-bold">✓</span>
                <span>Interventions en France, Tunisie et Maghreb</span>
              </div>
            </div>
          </div>

          <!-- Right Mini Form (6 cols) -->
          <div class="lg:col-span-6">
            <?php include __DIR__ . '/../partials/cta-form.php'; ?>
          </div>

        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

  <!-- Admin Edit Scripts (only loaded if logged in) -->
  <?php if (function_exists('is_admin') && is_admin()): ?>
  <script src="/assets/js/admin-edit.js" type="module" defer></script>
  <?php endif; ?>

  <!-- Scripts -->
  <script src="/assets/vendor/toastify/toastify.min.js" defer></script>
  <script src="/assets/js/main.js" type="module" defer></script>
</body>
</html>
