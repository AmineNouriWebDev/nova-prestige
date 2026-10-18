<?php
$header_phone = function_exists('setting') ? setting('phone') : '';
$header_phone_display = function_exists('setting') ? setting('phone_display', $header_phone) : $header_phone;
$current_page = $page_key ?? '';
?>
<header id="site-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-np-surface/85 backdrop-blur-md border-b border-np-border/60 dark:border-np-border/40" role="banner">
  <!-- Scroll progress bar: thin copper line at very top -->
  <div id="scroll-progress" class="h-0.5 bg-np-accent absolute top-0 left-0 w-0 transition-all duration-75 ease-out" role="progressbar" aria-label="Progression de lecture" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"></div>
  
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <nav class="flex items-center justify-between h-16 lg:h-20" aria-label="Navigation principale">
      
      <!-- Logo with triple-click admin trigger -->
      <a href="/" id="site-logo" class="flex items-center gap-3 flex-shrink-0 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent rounded-sm py-1" aria-label="NOVA PRESTIGE — Accueil">
        <!-- SVG Logo: NP monogram + wordmark + signature -->
        <svg class="h-10 lg:h-12 w-auto" viewBox="0 0 355 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <!-- Monogram Box / Chamfered Hex -->
          <g class="transition-transform duration-300 group-hover:scale-105 origin-center">
            <path d="M6 14L16 4H44L54 14V50L44 60H16L6 50V14Z" class="fill-np-primary/10 dark:fill-np-accent/15 stroke-np-primary dark:stroke-np-accent" stroke-width="2"/>
            <!-- N & P stylized technical lines -->
            <!-- Letter N -->
            <path d="M16 46V18L30 46V18" class="stroke-np-primary dark:stroke-np-accent" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
            <!-- Letter P -->
            <path d="M33 46V18H41C45 18 47.5 20.5 47.5 24.5C47.5 28.5 45 31 41 31H33" class="stroke-np-accent dark:stroke-white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <!-- Technical crosshair dot -->
            <circle cx="30" cy="32" r="1.5" class="fill-np-accent"/>
          </g>
          
          <!-- Wordmark NOVA PRESTIGE -->
          <text x="68" y="32" font-family="'Space Grotesk', system-ui, sans-serif" font-weight="700" font-size="21" letter-spacing="0.08em" class="fill-np-primary dark:fill-white">NOVA <tspan class="fill-np-accent">PRESTIGE</tspan></text>
          
          <!-- Technical Signature -->
          <text x="68" y="48" font-family="'JetBrains Mono', monospace" font-size="8.5" letter-spacing="0.06em" class="fill-np-text-muted">BUREAU D'ÉTUDES • CONSEIL INDUSTRIEL • FORMATION</text>
        </svg>
      </a>
      
      <!-- Desktop Nav (lg+) -->
      <div class="hidden lg:flex items-center gap-1 xl:gap-2">
        <!-- Mega-menu trigger for Expertises -->
        <div class="relative" id="mega-menu-wrapper">
          <button type="button" 
                  id="mega-menu-trigger" 
                  class="flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium transition-colors rounded-md text-np-text hover:text-np-accent focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent" 
                  aria-expanded="false" 
                  aria-haspopup="true" 
                  aria-controls="mega-menu-panel">
            <span>Expertises</span>
            <svg class="w-4 h-4 transition-transform duration-200" id="mega-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
        </div>

        <a href="/formation-technique-atelier" 
           class="px-3.5 py-2 text-sm font-medium transition-colors rounded-md <?= $current_page === 'formation-technique-atelier' ? 'text-np-accent font-semibold' : 'text-np-text hover:text-np-accent' ?>"
           <?= $current_page === 'formation-technique-atelier' ? 'aria-current="page"' : '' ?>>
          Formation
        </a>

        <a href="/france-tunisie-maghreb" 
           class="px-3.5 py-2 text-sm font-medium transition-colors rounded-md <?= $current_page === 'france-tunisie-maghreb' ? 'text-np-accent font-semibold' : 'text-np-text hover:text-np-accent' ?>"
           <?= $current_page === 'france-tunisie-maghreb' ? 'aria-current="page"' : '' ?>>
          Zones d'intervention
        </a>

        <a href="/a-propos" 
           class="px-3.5 py-2 text-sm font-medium transition-colors rounded-md <?= $current_page === 'a-propos' ? 'text-np-accent font-semibold' : 'text-np-text hover:text-np-accent' ?>"
           <?= $current_page === 'a-propos' ? 'aria-current="page"' : '' ?>>
          À propos
        </a>
      </div>

      <!-- Desktop Right Controls -->
      <div class="hidden lg:flex items-center gap-3">
        <?php if (!empty($header_phone)): ?>
        <a href="tel:<?= e($header_phone) ?>" class="flex items-center gap-1.5 text-xs font-mono font-medium text-np-text-muted hover:text-np-accent px-2 py-1.5 rounded transition-colors" aria-label="Téléphone : <?= e($header_phone_display) ?>">
          <svg class="w-3.5 h-3.5 text-np-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
          </svg>
          <span><?= e($header_phone_display) ?></span>
        </a>
        <?php endif; ?>

        <!-- Dark Mode Toggle Button -->
        <button type="button" 
                id="theme-toggle" 
                class="p-2 text-np-text-muted hover:text-np-accent rounded-lg border border-transparent hover:border-np-border transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent" 
                aria-label="Changer le thème d'affichage"
                title="Basculeur mode sombre/clair">
          <!-- Sun Icon (shown in dark mode) -->
          <svg class="w-5 h-5 hidden dark:block transition-transform duration-300 rotate-0 hover:rotate-45 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <!-- Moon Icon (shown in light mode) -->
          <svg class="w-5 h-5 block dark:hidden transition-transform duration-300 -rotate-12 hover:rotate-0 text-np-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>

        <!-- CTA Devis Button -->
        <a href="/contact?type=devis" 
           class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 rounded-md transition-all duration-200 shadow-sm hover:shadow hover:scale-[1.02] active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent focus-visible:ring-offset-2">
          <span>Demander un devis</span>
          <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
          </svg>
        </a>
      </div>
      
      <!-- Mobile Controls (< lg) -->
      <div class="flex lg:hidden items-center gap-1.5">
        <!-- Theme toggle mobile -->
        <button type="button" 
                id="mobile-theme-toggle" 
                class="p-2 text-np-text-muted hover:text-np-accent rounded-lg border border-np-border/40 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent" 
                aria-label="Changer le thème">
          <svg class="w-5 h-5 hidden dark:block text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <svg class="w-5 h-5 block dark:hidden text-np-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>

        <!-- Burger button -->
        <button type="button" 
                id="mobile-menu-trigger" 
                class="p-2.5 rounded-lg text-np-text hover:text-np-accent border border-np-border/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent" 
                aria-label="Ouvrir le menu de navigation" 
                aria-expanded="false" 
                aria-controls="mobile-menu-panel">
          <span class="sr-only">Menu</span>
          <div class="w-5 h-4 flex flex-col justify-between relative" aria-hidden="true">
            <span class="w-full h-0.5 bg-current rounded-full transition-all duration-300 origin-center" id="burger-line-1"></span>
            <span class="w-full h-0.5 bg-current rounded-full transition-all duration-200" id="burger-line-2"></span>
            <span class="w-full h-0.5 bg-current rounded-full transition-all duration-300 origin-center" id="burger-line-3"></span>
          </div>
        </button>
      </div>

    </nav>
  </div>
  
  <!-- Mega-menu panel (Desktop) -->
  <div id="mega-menu-panel" 
       class="hidden absolute top-full left-0 right-0 bg-np-surface/98 backdrop-blur-xl border-b border-np-border shadow-2xl transition-all duration-200 origin-top" 
       role="region" 
       aria-label="Sous-menu Expertises">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-12 gap-8">
        
        <!-- Left: 5 Cards Grid (8 cols) -->
        <div class="col-span-8">
          <div class="flex items-center justify-between pb-3 mb-6 border-b border-np-border">
            <span class="font-mono text-xs uppercase tracking-wider text-np-accent font-semibold">01 — Domaines d'expertises techniques</span>
            <a href="/#expertises" class="text-xs text-np-text-muted hover:text-np-accent transition-colors">Toutes les expertises →</a>
          </div>

          <div class="grid grid-cols-2 gap-4">
            
            <!-- Card 1 -->
            <a href="/bureau-etudes-faisabilite" class="group flex items-start gap-3.5 p-3 rounded-lg border border-transparent hover:border-np-border hover:bg-np-bg/60 transition-all duration-200">
              <div class="p-2 rounded bg-np-primary/10 dark:bg-np-primary/30 text-np-accent group-hover:bg-np-accent group-hover:text-white transition-colors flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
              </div>
              <div>
                <h4 class="font-grotesk font-semibold text-sm text-np-text group-hover:text-np-accent transition-colors">Bureau d'études & faisabilité</h4>
                <p class="text-xs text-np-text-muted mt-1 leading-relaxed">Études techniques et analyses de fabricabilité adaptées à vos machines.</p>
              </div>
            </a>

            <!-- Card 2 -->
            <a href="/prototypes-developpement-produits" class="group flex items-start gap-3.5 p-3 rounded-lg border border-transparent hover:border-np-border hover:bg-np-bg/60 transition-all duration-200">
              <div class="p-2 rounded bg-np-primary/10 dark:bg-np-primary/30 text-np-accent group-hover:bg-np-accent group-hover:text-white transition-colors flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
              </div>
              <div>
                <h4 class="font-grotesk font-semibold text-sm text-np-text group-hover:text-np-accent transition-colors">Prototypes & développement</h4>
                <p class="text-xs text-np-text-muted mt-1 leading-relaxed">Définition, mise au point et essais de pliage, poinçonnage et assemblage.</p>
              </div>
            </a>

            <!-- Card 3 -->
            <a href="/facades-metalliques-bardage-calepinage" class="group flex items-start gap-3.5 p-3 rounded-lg border border-transparent hover:border-np-border hover:bg-np-bg/60 transition-all duration-200">
              <div class="p-2 rounded bg-np-primary/10 dark:bg-np-primary/30 text-np-accent group-hover:bg-np-accent group-hover:text-white transition-colors flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                </svg>
              </div>
              <div>
                <h4 class="font-grotesk font-semibold text-sm text-np-text group-hover:text-np-accent transition-colors">Façades & calepinage</h4>
                <p class="text-xs text-np-text-muted mt-1 leading-relaxed">Calepinage, finitions et raccords conçus pour faciliter fabrication et pose.</p>
              </div>
            </a>

            <!-- Card 4 -->
            <a href="/methodes-industrialisation" class="group flex items-start gap-3.5 p-3 rounded-lg border border-transparent hover:border-np-border hover:bg-np-bg/60 transition-all duration-200">
              <div class="p-2 rounded bg-np-primary/10 dark:bg-np-primary/30 text-np-accent group-hover:bg-np-accent group-hover:text-white transition-colors flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <div>
                <h4 class="font-grotesk font-semibold text-sm text-np-text group-hover:text-np-accent transition-colors">Méthodes & industrialisation</h4>
                <p class="text-xs text-np-text-muted mt-1 leading-relaxed">Optimisation des gammes opératoires et appui aux équipes de fabrication.</p>
              </div>
            </a>

            <!-- Card 5 (spans 2 on small grid) -->
            <a href="/conseil-industriel-equipements" class="group flex items-start gap-3.5 p-3 rounded-lg border border-transparent hover:border-np-border hover:bg-np-bg/60 transition-all duration-200 col-span-2">
              <div class="p-2 rounded bg-np-primary/10 dark:bg-np-primary/30 text-np-accent group-hover:bg-np-accent group-hover:text-white transition-colors flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
              </div>
              <div>
                <h4 class="font-grotesk font-semibold text-sm text-np-text group-hover:text-np-accent transition-colors">Conseil industriel & équipements</h4>
                <p class="text-xs text-np-text-muted mt-1 leading-relaxed">Diagnostic technique, résolution de blocages et aide au choix d'équipements adaptés.</p>
              </div>
            </a>

          </div>
        </div>

        <!-- Right: Formation Spotlight Sidebar (4 cols) -->
        <div class="col-span-4 bg-np-bg/80 dark:bg-np-bg/40 border border-np-border rounded-xl p-5 flex flex-col justify-between">
          <div>
            <div class="flex items-center gap-2 mb-3">
              <span class="w-2 h-2 rounded-full bg-np-accent"></span>
              <span class="font-mono text-xs uppercase tracking-wider text-np-accent font-semibold">Focus atelier</span>
            </div>
            <h4 class="font-grotesk font-bold text-base text-np-text mb-2">Formation technique sur site</h4>
            <p class="text-xs text-np-text-muted leading-relaxed mb-4">
              Interventions concrètes directement sur vos machines : perfectionnement au pliage, poinçonnage et méthodes opératoires pour vos opérateurs.
            </p>
            <ul class="text-xs space-y-2 text-np-text-muted font-mono mb-4">
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Directement en atelier
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Contenu adapté à vos pièces
              </li>
              <li class="flex items-center gap-2">
                <span class="text-np-accent">✓</span> Transfert immédiat de savoir-faire
              </li>
            </ul>
          </div>
          <div class="pt-4 border-t border-np-border">
            <a href="/formation-technique-atelier" class="text-xs font-semibold text-np-accent hover:text-np-accent/80 flex items-center gap-1 group">
              <span>Découvrir l'approche formation</span>
              <span class="transition-transform group-hover:translate-x-1">→</span>
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Mobile Fullscreen Menu Panel (< lg) -->
  <div id="mobile-menu-panel" 
       class="hidden fixed inset-0 top-16 z-50 bg-np-bg/95 backdrop-blur-2xl border-t border-np-border overflow-y-auto p-6" 
       role="dialog" 
       aria-modal="true" 
       aria-label="Navigation mobile">
    <div class="flex flex-col min-h-[calc(100vh-5rem)] justify-between">
      <div class="space-y-4">
        
        <!-- Accordion Expertises -->
        <div class="border-b border-np-border pb-3">
          <button type="button" 
                  id="mobile-accordion-trigger" 
                  class="flex items-center justify-between w-full py-2.5 text-base font-grotesk font-semibold text-np-text" 
                  aria-expanded="false" 
                  aria-controls="mobile-expertises-list">
            <span>Expertises</span>
            <svg class="w-5 h-5 transition-transform duration-200" id="mobile-accordion-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          
          <div id="mobile-expertises-list" class="hidden pl-3 mt-2 space-y-2 border-l-2 border-np-accent/40">
            <a href="/bureau-etudes-faisabilite" class="block py-2 text-sm text-np-text-muted hover:text-np-accent">Bureau d'études & faisabilité</a>
            <a href="/prototypes-developpement-produits" class="block py-2 text-sm text-np-text-muted hover:text-np-accent">Prototypes & développement</a>
            <a href="/facades-metalliques-bardage-calepinage" class="block py-2 text-sm text-np-text-muted hover:text-np-accent">Façades & calepinage</a>
            <a href="/methodes-industrialisation" class="block py-2 text-sm text-np-text-muted hover:text-np-accent">Méthodes & industrialisation</a>
            <a href="/conseil-industriel-equipements" class="block py-2 text-sm text-np-text-muted hover:text-np-accent">Conseil industriel & équipements</a>
            <a href="/formation-technique-atelier" class="block py-2 text-sm text-np-accent font-medium">Formation technique sur site</a>
          </div>
        </div>

        <a href="/formation-technique-atelier" class="block py-3 text-base font-grotesk font-semibold text-np-text border-b border-np-border">Formation</a>
        <a href="/france-tunisie-maghreb" class="block py-3 text-base font-grotesk font-semibold text-np-text border-b border-np-border">Zones d'intervention</a>
        <a href="/a-propos" class="block py-3 text-base font-grotesk font-semibold text-np-text border-b border-np-border">À propos</a>
        <a href="/contact" class="block py-3 text-base font-grotesk font-semibold text-np-text border-b border-np-border">Contact</a>
      </div>

      <!-- Mobile Menu Bottom Actions -->
      <div class="pt-8 pb-12 space-y-4">
        <?php if (!empty($header_phone)): ?>
        <a href="tel:<?= e($header_phone) ?>" class="flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-np-surface border border-np-border text-sm font-mono text-np-text">
          <svg class="w-4 h-4 text-np-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
          </svg>
          <span><?= e($header_phone_display) ?></span>
        </a>
        <?php endif; ?>

        <a href="/contact?type=devis" class="flex items-center justify-center gap-2 w-full py-3.5 px-4 rounded-lg bg-np-accent text-white font-semibold text-sm shadow hover:bg-np-accent/90 transition-colors">
          <span>Demander un devis gratuit</span>
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</header>

<!-- Spacer for fixed header -->
<div class="h-16 lg:h-20" aria-hidden="true"></div>
