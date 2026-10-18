<?php
$footer_phone = function_exists('setting') ? setting('phone') : '';
$footer_phone_display = function_exists('setting') ? setting('phone_display', $footer_phone) : $footer_phone;
$footer_email = function_exists('setting') ? setting('contact_email') : '';
$footer_city = function_exists('setting') ? setting('city') : '';
$footer_linkedin = function_exists('setting') ? setting('linkedin') : '';
?>
<footer class="bg-np-primary text-slate-200 relative overflow-hidden border-t border-white/10" role="contentinfo">
  
  <!-- Subtle Blueprint Grid Background Overlay -->
  <div class="absolute inset-0 pointer-events-none opacity-5" aria-hidden="true">
    <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <pattern id="footer-grid" width="40" height="40" patternUnits="userSpaceOnUse">
          <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#FFFFFF" stroke-width="0.75" />
        </pattern>
      </defs>
      <rect width="100%" height="100%" fill="url(#footer-grid)" />
    </svg>
  </div>

  <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
      
      <!-- Col 1: Brand & Presentation (lg:col-span-4) -->
      <div class="lg:col-span-4 space-y-5">
        <a href="/" class="inline-flex items-center gap-3 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent rounded-sm py-1" aria-label="NOVA PRESTIGE — Accueil">
          <svg class="h-10 w-auto" viewBox="0 0 355 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <g>
              <path d="M6 14L16 4H44L54 14V50L44 60H16L6 50V14Z" class="fill-white/10 stroke-np-accent" stroke-width="2"/>
              <path d="M16 46V18L30 46V18" class="stroke-white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M33 46V18H41C45 18 47.5 20.5 47.5 24.5C47.5 28.5 45 31 41 31H33" class="stroke-np-accent" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="30" cy="32" r="1.5" class="fill-np-accent"/>
            </g>
            <text x="68" y="32" font-family="'Space Grotesk', system-ui, sans-serif" font-weight="700" font-size="21" letter-spacing="0.08em" class="fill-white">NOVA <tspan class="fill-np-accent">PRESTIGE</tspan></text>
            <text x="68" y="48" font-family="'JetBrains Mono', monospace" font-size="8.5" letter-spacing="0.06em" class="fill-blue-200/70">BUREAU D'ÉTUDES • CONSEIL INDUSTRIEL • FORMATION</text>
          </svg>
        </a>

        <p class="text-sm text-slate-300 leading-relaxed max-w-sm">
          <?= e(t('global.footer.signature', "Bureau d'études techniques • Conseil industriel • Formation")) ?>.
          Plus de 40 ans d'expertise en tôlerie industrielle, construction métallique et produits de façade.
        </p>

        <div class="pt-2">
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-mono text-np-accent">
            <span class="w-1.5 h-1.5 rounded-full bg-np-accent animate-pulse"></span>
            <span><?= e(t('global.footer.zones', 'France • Tunisie • Maghreb')) ?></span>
          </div>
        </div>
      </div>

      <!-- Col 2: Expertises (lg:col-span-3) -->
      <div class="lg:col-span-3 space-y-4">
        <h3 class="font-grotesk font-semibold text-sm uppercase tracking-wider text-white">Domaines d'expertise</h3>
        <ul class="space-y-2.5 text-sm text-slate-300">
          <li>
            <a href="/bureau-etudes-faisabilite" class="hover:text-np-accent transition-colors flex items-center gap-1.5 group">
              <span class="text-xs text-np-accent group-hover:translate-x-0.5 transition-transform">›</span>
              <span>Bureau d'études & faisabilité</span>
            </a>
          </li>
          <li>
            <a href="/prototypes-developpement-produits" class="hover:text-np-accent transition-colors flex items-center gap-1.5 group">
              <span class="text-xs text-np-accent group-hover:translate-x-0.5 transition-transform">›</span>
              <span>Prototypes & développement</span>
            </a>
          </li>
          <li>
            <a href="/facades-metalliques-bardage-calepinage" class="hover:text-np-accent transition-colors flex items-center gap-1.5 group">
              <span class="text-xs text-np-accent group-hover:translate-x-0.5 transition-transform">›</span>
              <span>Façades métalliques & calepinage</span>
            </a>
          </li>
          <li>
            <a href="/methodes-industrialisation" class="hover:text-np-accent transition-colors flex items-center gap-1.5 group">
              <span class="text-xs text-np-accent group-hover:translate-x-0.5 transition-transform">›</span>
              <span>Méthodes & industrialisation</span>
            </a>
          </li>
          <li>
            <a href="/conseil-industriel-equipements" class="hover:text-np-accent transition-colors flex items-center gap-1.5 group">
              <span class="text-xs text-np-accent group-hover:translate-x-0.5 transition-transform">›</span>
              <span>Conseil industriel & équipements</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Col 3: Navigation rapide (lg:col-span-2) -->
      <div class="lg:col-span-2 space-y-4">
        <h3 class="font-grotesk font-semibold text-sm uppercase tracking-wider text-white">Navigation</h3>
        <ul class="space-y-2.5 text-sm text-slate-300">
          <li>
            <a href="/formation-technique-atelier" class="hover:text-np-accent transition-colors">Formation sur site</a>
          </li>
          <li>
            <a href="/france-tunisie-maghreb" class="hover:text-np-accent transition-colors">Zones d'intervention</a>
          </li>
          <li>
            <a href="/a-propos" class="hover:text-np-accent transition-colors">À propos</a>
          </li>
          <li>
            <a href="/contact?type=devis" class="hover:text-np-accent transition-colors font-medium text-np-accent">Demande de devis</a>
          </li>
          <li>
            <a href="/#faq" class="hover:text-np-accent transition-colors">Questions fréquentes</a>
          </li>
        </ul>
      </div>

      <!-- Col 4: Contact & Informations (lg:col-span-3) -->
      <div class="lg:col-span-3 space-y-4">
        <h3 class="font-grotesk font-semibold text-sm uppercase tracking-wider text-white">Contact direct</h3>
        
        <div class="space-y-3 text-sm text-slate-300">
          <?php if (!empty($footer_phone)): ?>
          <div class="flex items-start gap-2.5">
            <svg class="w-4 h-4 text-np-accent mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <a href="tel:<?= e($footer_phone) ?>" class="font-mono hover:text-np-accent transition-colors"><?= e($footer_phone_display) ?></a>
          </div>
          <?php endif; ?>

          <?php if (!empty($footer_email)): ?>
          <div class="flex items-start gap-2.5">
            <svg class="w-4 h-4 text-np-accent mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <a href="mailto:<?= e($footer_email) ?>" class="font-mono hover:text-np-accent transition-colors break-all"><?= e($footer_email) ?></a>
          </div>
          <?php endif; ?>

          <?php if (!empty($footer_city)): ?>
          <div class="flex items-start gap-2.5">
            <svg class="w-4 h-4 text-np-accent mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span><?= e($footer_city) ?></span>
          </div>
          <?php endif; ?>

          <?php if (!empty($footer_linkedin)): ?>
          <div class="flex items-start gap-2.5 pt-1">
            <a href="<?= e($footer_linkedin) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-xs font-mono text-slate-300 hover:text-np-accent transition-colors">
              <svg class="w-4 h-4 fill-current text-np-accent" viewBox="0 0 24 24">
                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
              </svg>
              <span>Profil LinkedIn</span>
            </a>
          </div>
          <?php endif; ?>
        </div>

        <div class="pt-3">
          <a href="/contact" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/15 border border-white/20 rounded-md text-xs font-mono text-white transition-colors">
            <span>Écrire à Ali Nouiri</span>
            <span>→</span>
          </a>
        </div>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="mt-14 pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-400">
      
      <!-- Copyright & AI Mention -->
      <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-center md:text-left">
        <span><?= e(t('global.footer.copyright', '© ' . date('Y') . ' NOVA PRESTIGE. Tous droits réservés.')) ?></span>
        <span class="hidden sm:inline text-white/20">•</span>
        <span class="italic text-slate-400/80"><?= e(t('global.footer.ai_mention', 'Illustrations générées par IA.')) ?></span>
      </div>

      <!-- Legal Links -->
      <div class="flex items-center gap-6">
        <a href="/mentions-legales" class="hover:text-white transition-colors">Mentions légales</a>
        <a href="/politique-confidentialite" class="hover:text-white transition-colors">Politique de confidentialité</a>
        
        <!-- Back to top button -->
        <a href="#top" 
           id="back-to-top" 
           class="p-2 rounded bg-white/10 hover:bg-np-accent text-white transition-all duration-200" 
           aria-label="Retour en haut de la page"
           title="Haut de page">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
          </svg>
        </a>
      </div>

    </div>
  </div>
</footer>
