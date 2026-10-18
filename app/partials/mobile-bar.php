<?php
$mobile_phone = function_exists('setting') ? setting('phone') : '';
$mobile_phone_clean = preg_replace('/[^0-9+]/', '', $mobile_phone);

$mobile_wa = function_exists('setting') ? setting('whatsapp') : '';
$mobile_wa_clean = preg_replace('/[^0-9]/', '', $mobile_wa);
?>
<!-- Fixed bottom action bar (mobile only, <1024px) -->
<nav id="mobile-action-bar" 
     class="fixed bottom-0 left-0 right-0 z-40 lg:hidden bg-np-surface/95 backdrop-blur-md border-t border-np-border shadow-[0_-4px_16px_rgba(0,0,0,0.06)] transition-transform duration-300" 
     style="padding-bottom: env(safe-area-inset-bottom)"
     aria-label="Actions rapides mobiles">
  <div class="flex items-stretch divide-x divide-np-border">
    
    <?php if (!empty($mobile_phone_clean)): ?>
    <!-- Appeler button -->
    <a href="tel:<?= e($mobile_phone_clean) ?>" 
       class="flex-1 flex flex-col items-center justify-center min-h-[52px] py-2 px-1 text-center text-np-text hover:text-np-accent active:bg-np-bg transition-colors"
       aria-label="Appeler NOVA PRESTIGE">
      <svg class="w-5 h-5 text-np-accent mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
      </svg>
      <span class="text-[11px] font-mono font-medium leading-none">Appeler</span>
    </a>
    <?php endif; ?>

    <?php if (!empty($mobile_wa_clean)): ?>
    <!-- WhatsApp button -->
    <a href="https://wa.me/<?= e($mobile_wa_clean) ?>" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="flex-1 flex flex-col items-center justify-center min-h-[52px] py-2 px-1 text-center text-np-text hover:text-emerald-500 active:bg-np-bg transition-colors"
       aria-label="Contacter sur WhatsApp">
      <svg class="w-5 h-5 text-emerald-500 mb-1" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M12.031 2c-5.508 0-9.984 4.475-9.984 9.984 0 1.76.459 3.479 1.332 4.992l-1.417 5.178 5.305-1.391c1.457.795 3.097 1.217 4.764 1.217 5.508 0 9.984-4.476 9.984-9.984 0-5.509-4.476-9.984-9.984-9.984zm5.792 14.154c-.244.686-1.427 1.314-1.97 1.378-.49.057-1.119.082-3.606-.948-2.671-1.107-4.385-3.834-4.517-4.009-.134-.175-1.077-1.434-1.077-2.736 0-1.302.684-1.944.928-2.208.244-.264.533-.33.71-.33.178 0 .356.002.511.01.167.008.39-.063.61.464.223.535.757 1.848.824 1.981.066.134.111.29.022.467-.089.177-.133.289-.267.444-.133.155-.28.347-.399.467-.133.133-.272.278-.117.545.155.267.689 1.136 1.478 1.839 1.015.905 1.871 1.185 2.138 1.318.267.133.422.111.578-.067.155-.178.667-.777.844-1.044.178-.267.356-.222.6-.133.244.089 1.556.733 1.822.867.267.133.444.2.511.311.067.111.067.644-.177 1.33z"/>
      </svg>
      <span class="text-[11px] font-mono font-medium leading-none">WhatsApp</span>
    </a>
    <?php endif; ?>

    <!-- Devis button (always shown) -->
    <a href="/contact?type=devis" 
       class="flex-1 flex flex-col items-center justify-center min-h-[52px] py-2 px-1 text-center bg-np-accent text-white hover:bg-np-accent/90 active:bg-np-accent/80 transition-colors"
       aria-label="Demande de devis">
      <svg class="w-5 h-5 text-white mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
      </svg>
      <span class="text-[11px] font-mono font-semibold tracking-wide leading-none">Devis</span>
    </a>

  </div>
</nav>

<!-- Spacer for mobile action bar to prevent content obstruction -->
<div class="h-14 lg:hidden" id="mobile-bar-spacer" aria-hidden="true"></div>
