<?php
declare(strict_types=1);

$page_key = 'contact';
$seo_data = function_exists('seo') ? seo('contact') : [
    'title' => 'Contact & Demande de devis | NOVA PRESTIGE',
    'description' => 'Décrivez votre projet industriel ou votre besoin de formation. NOVA PRESTIGE vous répond rapidement pour une étude de faisabilité ou un devis.',
    'canonical' => url('/contact')
];

$preselectedType = $_GET['type'] ?? 'projet';
$preselectedService = $_GET['service'] ?? '';

include __DIR__ . '/../partials/head.php';
?>
<body class="bg-np-bg text-np-text font-inter antialiased selection:bg-np-accent selection:text-white" <?= function_exists('is_admin') && is_admin() ? 'data-admin="1"' : '' ?> id="top">

  <!-- Accessibility Skip link -->
  <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 bg-np-accent text-white px-5 py-2.5 rounded-md shadow-xl z-50 font-medium">Aller au contenu principal</a>

  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main id="main-content" class="pt-28 pb-20 sm:pb-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
      
      <!-- Page Header -->
      <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-np-accent/10 border border-np-accent/20 text-np-accent font-mono text-xs font-semibold tracking-wider uppercase mb-4">
          <span class="w-2 h-2 rounded-full bg-np-accent animate-pulse" aria-hidden="true"></span>
          <span>Contact & Devis</span>
        </div>
        
        <h1 class="font-grotesk text-3xl sm:text-4xl lg:text-5xl font-bold text-np-text tracking-tight mb-4" data-edit="seo.contact.title" data-type="text">
          <?= e(t('seo.contact.title')) ?>
        </h1>
        
        <p class="text-np-text-muted text-base sm:text-lg leading-relaxed" data-edit="seo.contact.description" data-type="text">
          <?= e(t('seo.contact.description')) ?>
        </p>
      </div>

      <!-- Main Form Container -->
      <div class="bg-np-surface border border-np-border rounded-2xl shadow-xl overflow-hidden p-6 sm:p-10 lg:p-12">
        <form action="/api/contact-submit" method="POST" id="main-contact-form" class="space-y-8" data-ajax="true" novalidate>
          
          <!-- Hidden Anti-spam and CSRF Tokens -->
          <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
          <input type="hidden" name="ts_token" value="<?= e(generate_form_token()) ?>">
          
          <!-- Anti-spam Honeypot -->
          <div style="display:none !important; position:absolute !important; left:-9999px !important; top:-9999px !important;" aria-hidden="true">
            <label for="full_website_url">Ne pas remplir ce champ si vous êtes humain</label>
            <input type="text" id="full_website_url" name="website_url" tabindex="-1" autocomplete="off" value="">
          </div>

          <!-- Type of Request Toggle -->
          <div>
            <label class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-3">
              Type de demande <span class="text-np-accent">*</span>
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
              <label class="relative flex items-center justify-center p-3.5 rounded-xl border border-np-border cursor-pointer hover:border-np-accent transition-all duration-150 has-[:checked]:border-np-accent has-[:checked]:bg-np-accent/5">
                <input type="radio" name="request_type" value="projet" class="sr-only" <?= $preselectedType === 'projet' ? 'checked' : '' ?>>
                <span class="text-sm font-medium text-np-text">Étude de projet</span>
              </label>
              <label class="relative flex items-center justify-center p-3.5 rounded-xl border border-np-border cursor-pointer hover:border-np-accent transition-all duration-150 has-[:checked]:border-np-accent has-[:checked]:bg-np-accent/5">
                <input type="radio" name="request_type" value="devis" class="sr-only" <?= $preselectedType === 'devis' ? 'checked' : '' ?>>
                <span class="text-sm font-medium text-np-text">Demande de devis</span>
              </label>
              <label class="relative flex items-center justify-center p-3.5 rounded-xl border border-np-border cursor-pointer hover:border-np-accent transition-all duration-150 has-[:checked]:border-np-accent has-[:checked]:bg-np-accent/5">
                <input type="radio" name="request_type" value="contact" class="sr-only" <?= $preselectedType === 'contact' ? 'checked' : '' ?>>
                <span class="text-sm font-medium text-np-text">Information générale</span>
              </label>
            </div>
          </div>

          <!-- Contact Coordinates -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="contact_name" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-2">
                Nom complet <span class="text-np-accent">*</span>
              </label>
              <input type="text" id="contact_name" name="name" required placeholder="Ex. Jean Dupont" class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text text-sm focus:outline-none focus:ring-2 focus:ring-np-accent">
            </div>

            <div>
              <label for="contact_company" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-2">
                Entreprise / Société
              </label>
              <input type="text" id="contact_company" name="company" placeholder="Ex. Métal Façade SAS" class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text text-sm focus:outline-none focus:ring-2 focus:ring-np-accent">
            </div>

            <div>
              <label for="contact_email" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-2">
                Adresse e-mail <span class="text-np-accent">*</span>
              </label>
              <input type="email" id="contact_email" name="email" required placeholder="contact@entreprise.com" class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text text-sm focus:outline-none focus:ring-2 focus:ring-np-accent">
            </div>

            <div>
              <label for="contact_phone" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-2">
                Téléphone
              </label>
              <input type="tel" id="contact_phone" name="phone" placeholder="+33 6 00 00 00 00 / +216 ..." class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text text-sm focus:outline-none focus:ring-2 focus:ring-np-accent">
            </div>
          </div>

          <!-- Project Details -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label for="contact_country" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-2">
                Pays d'intervention <span class="text-np-accent">*</span>
              </label>
              <select id="contact_country" name="country" required class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text text-sm focus:outline-none focus:ring-2 focus:ring-np-accent">
                <option value="" disabled selected>Sélectionnez un pays</option>
                <option value="France">France</option>
                <option value="Tunisie">Tunisie</option>
                <option value="Algérie">Algérie</option>
                <option value="Maroc">Maroc</option>
                <option value="Libye">Libye</option>
                <option value="Mauritanie">Mauritanie</option>
                <option value="Autre">Autre</option>
              </select>
            </div>

            <div>
              <label for="contact_service" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-2">
                Domaine d'intervention
              </label>
              <select id="contact_service" name="service" class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text text-sm focus:outline-none focus:ring-2 focus:ring-np-accent">
                <option value="">Sélectionnez un domaine</option>
                <option value="Bureau d'études & faisabilité">Bureau d'études & faisabilité</option>
                <option value="Prototypes & développement de produits">Prototypes & développement de produits</option>
                <option value="Façades métalliques, bardage & calepinage">Façades métalliques & calepinage</option>
                <option value="Méthodes & industrialisation">Méthodes & industrialisation</option>
                <option value="Conseil industriel & équipements">Conseil industriel & équipements</option>
                <option value="Formation technique sur site" <?= $preselectedService === 'formation' ? 'selected' : '' ?>>Formation technique sur site</option>
                <option value="Autre">Autre</option>
              </select>
            </div>

            <div>
              <label for="contact_mode" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-2">
                Modalité souhaitée
              </label>
              <select id="contact_mode" name="mode" class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text text-sm focus:outline-none focus:ring-2 focus:ring-np-accent">
                <option value="À définir">À définir</option>
                <option value="Sur site">Sur site (en atelier)</option>
                <option value="À distance">À distance</option>
              </select>
            </div>
          </div>

          <!-- Description / Need -->
          <div>
            <label for="contact_message" class="block text-xs font-mono font-medium uppercase tracking-wider text-np-text mb-2">
              Description de votre besoin ou projet <span class="text-np-accent">*</span>
            </label>
            <textarea id="contact_message" name="message" rows="5" required minlength="20" placeholder="Décrivez votre problématique technique, le profil concerné, les contraintes d'atelier, les délais envisagés..." class="w-full px-4 py-3 rounded-lg bg-np-bg border border-np-border text-np-text text-sm focus:outline-none focus:ring-2 focus:ring-np-accent resize-y"></textarea>
            <p class="text-xs text-np-text-muted mt-1.5 font-mono">Minimum 20 caractères</p>
          </div>

          <!-- RGPD Agreement -->
          <div class="flex items-start gap-3">
            <input type="checkbox" id="contact_rgpd" name="rgpd" value="1" required class="mt-1 w-4 h-4 rounded border-np-border text-np-accent focus:ring-np-accent">
            <label for="contact_rgpd" class="text-xs text-np-text-muted leading-relaxed">
              J'accepte que les informations saisies soient utilisées par NOVA PRESTIGE exclusivement pour étudier ma demande et me recontacter. Aucune donnée n'est cédée à des tiers.
            </label>
          </div>

          <!-- Submit Button -->
          <div>
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-np-accent hover:bg-np-accent/90 active:scale-[0.98] rounded-xl shadow-lg transition-all duration-150 group">
              <span>Envoyer ma demande</span>
              <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </button>
          </div>

        </form>
      </div>

    </div>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>

</body>
</html>
