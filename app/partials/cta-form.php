<?php
$csrf = function_exists('csrf_token') ? csrf_token() : '';
$timestamp = time();
$ts_token = base64_encode($timestamp . ':' . hash_hmac('sha256', (string)$timestamp, 'nova_prestige_secret_salt'));
?>
<form action="/api/contact-submit" 
      method="POST" 
      class="np-contact-form bg-np-surface dark:bg-np-surface/80 p-6 sm:p-8 rounded-2xl border border-np-border shadow-xl backdrop-blur-sm relative"
      data-ajax="true" 
      id="mini-contact-form"
      novalidate>
  
  <!-- Security Hidden Fields -->
  <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
  <input type="hidden" name="ts_token" value="<?= e($ts_token) ?>">
  <input type="hidden" name="request_type" value="contact">
  
  <!-- Anti-spam Honeypot (hidden from human visitors) -->
  <div style="display:none !important; position:absolute !important; left:-9999px !important; top:-9999px !important;" aria-hidden="true">
    <label for="form_website_url">Ne pas remplir ce champ si vous êtes humain</label>
    <input type="text" id="form_website_url" name="website_url" tabindex="-1" autocomplete="off" value="">
  </div>

  <div class="space-y-4">
    
    <!-- Nom -->
    <div>
      <label for="cta_name" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-1.5">
        Nom complet <span class="text-np-accent" aria-hidden="true">*</span>
      </label>
      <input type="text" 
             id="cta_name" 
             name="name" 
             required 
             placeholder="Ali Ben Amor" 
             class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text placeholder-np-text-muted/60 text-sm focus:outline-none focus:ring-2 focus:ring-np-accent focus:border-transparent transition-all duration-150"
             aria-required="true">
    </div>

    <!-- Email -->
    <div>
      <label for="cta_email" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-1.5">
        Adresse e-mail <span class="text-np-accent" aria-hidden="true">*</span>
      </label>
      <input type="email" 
             id="cta_email" 
             name="email" 
             required 
             placeholder="contact@entreprise.com" 
             class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text placeholder-np-text-muted/60 text-sm focus:outline-none focus:ring-2 focus:ring-np-accent focus:border-transparent transition-all duration-150"
             aria-required="true">
    </div>

    <!-- Message -->
    <div>
      <label for="cta_message" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-1.5">
        Votre message ou besoin <span class="text-np-accent" aria-hidden="true">*</span>
      </label>
      <textarea id="cta_message" 
                name="message" 
                rows="4" 
                required 
                placeholder="Présentez brièvement votre problématique technique, projet de profil ou besoin de formation..."
                class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text placeholder-np-text-muted/60 text-sm focus:outline-none focus:ring-2 focus:ring-np-accent focus:border-transparent transition-all duration-150 resize-y"
                aria-required="true"></textarea>
    </div>

    <!-- Submit button + Link to full form -->
    <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4">
      <button type="submit" 
              class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-white bg-np-accent hover:bg-np-accent/90 active:scale-[0.98] rounded-lg shadow-md transition-all duration-150 group disabled:opacity-50 disabled:pointer-events-none">
        <span class="text-white font-semibold">Envoyer ma demande</span>
        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
        </svg>
      </button>

      <a href="/contact" class="text-xs font-mono text-np-text-muted hover:text-np-accent transition-colors flex items-center gap-1 group py-2">
        <span>Formulaire détaillé & devis</span>
        <span class="transition-transform group-hover:translate-x-0.5">→</span>
      </a>
    </div>

  </div>
</form>
