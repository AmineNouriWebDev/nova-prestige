<?php
declare(strict_types=1);

$page_key = 'projet-partenaires';
$seo_data = function_exists('seo') ? seo($page_key) : [
    'title' => 'Notre projet industriel et recherche de partenaires | NOVA PRESTIGE',
    'description' => 'NOVA PRESTIGE recherche des partenaires industriels et financiers pour développer une activité de façades métalliques, bardage, pliage et fabrication de pièces spécifiques.',
    'canonical' => url('/projet-partenaires')
];
$heroImage = img('partenaires.hero.image', '/assets/img/service-prototypes.webp', 'Prototype de pièce métallique en atelier industriel');

include __DIR__ . '/../partials/head.php';
?>
<body class="bg-np-bg text-np-text font-inter antialiased selection:bg-np-accent selection:text-white" <?= function_exists('is_admin') && is_admin() ? 'data-admin="1"' : '' ?> data-page="<?= e($page_key) ?>" id="top">
  <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 rounded-md bg-np-accent px-5 py-2.5 font-medium text-white shadow-xl">Aller au contenu principal</a>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main id="main-content">
    <section class="relative overflow-hidden bg-np-primary text-white" aria-labelledby="project-title">
      <div class="absolute inset-0">
        <img src="<?= e($heroImage['src']) ?>" alt="<?= e($heroImage['alt']) ?>" class="h-full w-full object-cover opacity-25" fetchpriority="high" data-edit="partenaires.hero.image" data-type="image">
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-r from-np-primary via-np-primary/95 to-np-primary/60"></div>
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-np-primary/80 via-transparent to-transparent"></div>
      </div>
      <div class="container relative mx-auto px-4 pb-20 pt-16 sm:px-6 sm:pb-24 lg:px-8 lg:pb-28 lg:pt-20">
        <nav class="mb-10 flex items-center gap-2 text-xs font-mono text-blue-100/70" aria-label="Fil d'Ariane">
          <a href="/" class="transition hover:text-white">Accueil</a>
          <span aria-hidden="true">/</span>
          <span class="text-np-accent">Notre projet</span>
        </nav>
        <div class="max-w-4xl">
          <p class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 font-mono text-xs font-semibold uppercase tracking-widest text-np-accent" data-edit="partenaires.hero.eyebrow" data-type="text">
            <?= e(t('partenaires.hero.eyebrow', 'Projet industriel · France & Tunisie')) ?>
          </p>
          <h1 id="project-title" class="mb-6 font-grotesk text-3xl font-bold leading-tight tracking-tight sm:text-4xl lg:text-6xl" data-edit="partenaires.hero.title" data-type="text">
            <?= e(t('partenaires.hero.title', 'NOTRE PROJET – OBJECTIFS ET RECHERCHE DE PARTENAIRES')) ?>
          </h1>
          <p class="max-w-3xl text-base leading-relaxed text-blue-100 sm:text-lg" data-edit="partenaires.hero.lead" data-type="text">
            <?= e(t('partenaires.hero.lead', 'Construire une nouvelle activité de fabrication métallique, de la conception et du prototype en France à la production en Tunisie. Nous recherchons des partenaires prêts à bâtir ce projet industriel avec NOVA PRESTIGE.')) ?>
          </p>
          <a href="#contact-partenariat" class="mt-8 inline-flex items-center justify-center gap-3 rounded-lg bg-np-accent px-6 py-4 text-center text-sm font-bold text-white shadow-xl transition hover:-translate-y-0.5 hover:bg-np-accent/90 sm:px-8">
            <span data-edit="partenaires.hero.cta" data-type="text"><?= e(t('partenaires.hero.cta', 'DEVENIR PARTENAIRE – ÉTUDIONS ENSEMBLE NOTRE COLLABORATION')) ?></span>
            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </a>
          <div class="mt-9 flex flex-wrap gap-3 text-xs font-mono text-blue-100">
            <span class="rounded-full border border-white/20 bg-white/10 px-3 py-2" data-edit="partenaires.hero.badge1" data-type="text"><?= e(t('partenaires.hero.badge1', '40+ ans d’expérience industrielle')) ?></span>
            <span class="rounded-full border border-white/20 bg-white/10 px-3 py-2" data-edit="partenaires.hero.badge2" data-type="text"><?= e(t('partenaires.hero.badge2', 'Prototypage en France')) ?></span>
            <span class="rounded-full border border-white/20 bg-white/10 px-3 py-2" data-edit="partenaires.hero.badge3" data-type="text"><?= e(t('partenaires.hero.badge3', 'Production progressive en Tunisie')) ?></span>
          </div>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24" aria-labelledby="objective-title">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-10 max-w-3xl text-center">
          <p class="label-tech mb-3">01 — LE PROJET</p>
          <h2 id="objective-title" class="mb-4 font-grotesk text-3xl font-bold sm:text-4xl" data-edit="partenaires.objective.title" data-type="text"><?= e(t('partenaires.objective.title', 'Notre objectif')) ?></h2>
          <p class="text-base leading-relaxed text-np-text-muted sm:text-lg" data-edit="partenaires.objective.lead" data-type="text">
            <?= e(t('partenaires.objective.lead', 'Développer une activité spécialisée dans les façades métalliques, le bardage, le pliage industriel et la fabrication de pièces métalliques spécifiques.')) ?>
          </p>
        </div>
        <div class="grid gap-5 lg:grid-cols-2">
          <article class="rounded-2xl border border-np-border bg-np-surface p-7 shadow-sm sm:p-9">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-np-accent/10 text-np-accent">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l8-4v18m6 0V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01"/></svg>
            </div>
            <h3 class="mb-3 font-grotesk text-xl font-bold" data-edit="partenaires.objective.france.title" data-type="text"><?= e(t('partenaires.objective.france.title', 'En France — concevoir et valider')) ?></h3>
            <p class="leading-relaxed text-np-text-muted" data-edit="partenaires.objective.france.text" data-type="text">
              <?= e(t('partenaires.objective.france.text', 'Réaliser les études techniques, concevoir et développer les produits, fabriquer les prototypes, conduire les essais et valider les solutions avant leur industrialisation.')) ?>
            </p>
          </article>
          <article class="rounded-2xl border border-np-border bg-np-surface p-7 shadow-sm sm:p-9">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-np-accent/10 text-np-accent">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3m14.5-6.5l-11 13m0-13l11 13M5 5h14v14H5z"/></svg>
            </div>
            <h3 class="mb-3 font-grotesk text-xl font-bold" data-edit="partenaires.objective.tunisie.title" data-type="text"><?= e(t('partenaires.objective.tunisie.title', 'En Tunisie — produire progressivement')) ?></h3>
            <p class="leading-relaxed text-np-text-muted" data-edit="partenaires.objective.tunisie.text" data-type="text">
              <?= e(t('partenaires.objective.tunisie.text', 'Créer progressivement une unité de production pour fabriquer les produits validés en France, d’abord en petites séries, puis selon les besoins du marché.')) ?>
            </p>
          </article>
        </div>
      </div>
    </section>

    <section class="border-y border-np-border bg-np-surface/60 py-16 sm:py-20 lg:py-24" aria-labelledby="partners-title">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-10 max-w-3xl text-center">
          <p class="label-tech mb-3">02 — LES COLLABORATIONS</p>
          <h2 id="partners-title" class="mb-4 font-grotesk text-3xl font-bold sm:text-4xl" data-edit="partenaires.search.title" data-type="text"><?= e(t('partenaires.search.title', 'Notre recherche de partenaires')) ?></h2>
          <p class="text-base leading-relaxed text-np-text-muted" data-edit="partenaires.search.lead" data-type="text">
            <?= e(t('partenaires.search.lead', 'Nous recherchons des partenaires industriels, des investisseurs et des entreprises souhaitant participer au développement de ce projet. Plusieurs formes de collaboration sont envisageables :')) ?>
          </p>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <?php
          $collaborations = [
              ['equipment', 'Financement ou acquisition de machines et équipements', 'Moyens de production adaptés aux opérations de pliage, poinçonnage et fabrication.'],
              ['industrial', 'Partenariat industriel', 'Partage de compétences et mise à disposition de moyens de production.'],
              ['prototype', 'Atelier de prototypage en France', 'Participation au développement d’un espace dédié aux essais et à la validation.'],
              ['tunisia', 'Unité de production en Tunisie', 'Accompagnement à la création progressive d’un outil de fabrication local.'],
              ['commercial', 'Développement commercial', 'Partenariats commerciaux et création de nouveaux produits adaptés au marché.'],
          ];
          foreach ($collaborations as [$key, $title, $text]):
          ?>
          <article class="rounded-xl border border-np-border bg-np-bg p-6 transition hover:-translate-y-1 hover:border-np-accent/50 hover:shadow-lg">
            <span class="mb-4 flex h-10 w-10 items-center justify-center rounded-lg bg-np-accent/10 font-mono text-sm font-bold text-np-accent" aria-hidden="true">+</span>
            <h3 class="mb-2 font-grotesk text-lg font-bold" data-edit="partenaires.search.<?= e($key) ?>.title" data-type="text"><?= e(t('partenaires.search.' . $key . '.title', $title)) ?></h3>
            <p class="text-sm leading-relaxed text-np-text-muted" data-edit="partenaires.search.<?= e($key) ?>.text" data-type="text"><?= e(t('partenaires.search.' . $key . '.text', $text)) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24" aria-labelledby="knowhow-title">
      <div class="container mx-auto grid gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:items-center lg:px-8">
        <div class="lg:col-span-5">
          <?php $knowhowImage = img('partenaires.knowhow.image', '/assets/img/service-methodes.webp', 'Presse plieuse et équipement de tôlerie industrielle'); ?>
          <div class="relative overflow-hidden rounded-2xl border border-np-border shadow-xl">
            <img src="<?= e($knowhowImage['src']) ?>" alt="<?= e($knowhowImage['alt']) ?>" class="aspect-[4/3] w-full object-cover" loading="lazy" data-edit="partenaires.knowhow.image" data-type="image">
            <div class="absolute bottom-4 left-4 rounded-lg border border-white/20 bg-np-primary/90 px-4 py-3 text-white backdrop-blur">
              <span class="block font-grotesk text-2xl font-bold text-np-accent" data-edit="partenaires.knowhow.experience" data-type="text"><?= e(t('partenaires.knowhow.experience', '40+ ans')) ?></span>
              <span class="text-xs" data-edit="partenaires.knowhow.caption" data-type="text"><?= e(t('partenaires.knowhow.caption', 'd’expérience dans la construction métallique')) ?></span>
            </div>
          </div>
        </div>
        <div class="lg:col-span-7">
          <p class="label-tech mb-3">03 — L’EXPÉRIENCE</p>
          <h2 id="knowhow-title" class="mb-5 font-grotesk text-3xl font-bold sm:text-4xl" data-edit="partenaires.knowhow.title" data-type="text"><?= e(t('partenaires.knowhow.title', 'Notre savoir-faire')) ?></h2>
          <p class="mb-6 leading-relaxed text-np-text-muted" data-edit="partenaires.knowhow.lead" data-type="text">
            <?= e(t('partenaires.knowhow.lead', 'Le projet s’appuie sur plus de 40 ans d’expérience dans l’industrie de la construction métallique, acquise chez ArcelorMittal Construction France.')) ?>
          </p>
          <ul class="grid gap-3 sm:grid-cols-2">
            <?php
            $expertiseItems = [
                'Pliage et mise au point de pièces',
                'Poinçonnage et déroulage',
                'Soudure et assemblage',
                'Méthodes et organisation industrielles',
                'Développement de produits',
                'Industrialisation et transfert en production',
            ];
            foreach ($expertiseItems as $index => $item):
            ?>
            <li class="flex items-start gap-3 rounded-lg border border-np-border bg-np-surface p-4 text-sm">
              <span class="mt-0.5 text-np-accent" aria-hidden="true">✓</span>
              <span data-edit="partenaires.knowhow.item<?= $index + 1 ?>" data-type="text"><?= e(t('partenaires.knowhow.item' . ($index + 1), $item)) ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </section>

    <section class="bg-np-primary py-16 text-white sm:py-20 lg:py-24" aria-labelledby="benefits-title">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-10 max-w-3xl text-center">
          <p class="mb-3 font-mono text-xs font-semibold uppercase tracking-widest text-np-accent">04 — UNE AMBITION COMMUNE</p>
          <h2 id="benefits-title" class="font-grotesk text-3xl font-bold sm:text-4xl" data-edit="partenaires.benefits.title" data-type="text"><?= e(t('partenaires.benefits.title', 'Pourquoi devenir partenaire ?')) ?></h2>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
          <?php
          $benefits = [
              'Participer au lancement d’un projet industriel évolutif.',
              'Bénéficier d’une expertise technique de plus de 40 ans.',
              'Développer de nouveaux produits et de nouvelles opportunités commerciales.',
              'Associer développement en France et production en Tunisie.',
              'Construire une collaboration industrielle avec des perspectives à long terme.',
          ];
          foreach ($benefits as $index => $benefit):
          ?>
          <div class="rounded-xl border border-white/15 bg-white/5 p-5">
            <span class="mb-4 block font-mono text-sm font-bold text-np-accent">0<?= $index + 1 ?></span>
            <p class="text-sm leading-relaxed text-blue-50" data-edit="partenaires.benefits.item<?= $index + 1 ?>" data-type="text"><?= e(t('partenaires.benefits.item' . ($index + 1), $benefit)) ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section id="contact-partenariat" class="scroll-mt-24 py-16 sm:py-20 lg:py-24" aria-labelledby="partnership-contact-title">
      <div class="container mx-auto grid gap-10 px-4 sm:px-6 lg:grid-cols-5 lg:gap-14 lg:px-8">
        <div class="lg:col-span-2">
          <p class="label-tech mb-3">05 — PRENONS CONTACT</p>
          <h2 id="partnership-contact-title" class="mb-5 font-grotesk text-3xl font-bold leading-tight sm:text-4xl" data-edit="partenaires.contact.title" data-type="text"><?= e(t('partenaires.contact.title', 'Étudions ensemble notre collaboration')) ?></h2>
          <p class="mb-7 leading-relaxed text-np-text-muted" data-edit="partenaires.contact.lead" data-type="text">
            <?= e(t('partenaires.contact.lead', 'Vous souhaitez investir, mettre à disposition des équipements ou contribuer au développement industriel et commercial du projet ? Présentez-nous votre entreprise et votre proposition.')) ?>
          </p>
          <div class="rounded-xl border border-np-accent/30 bg-np-accent/5 p-5">
            <p class="font-semibold" data-edit="partenaires.contact.promise.title" data-type="text"><?= e(t('partenaires.contact.promise.title', 'Chaque proposition sera étudiée avec attention.')) ?></p>
            <p class="mt-2 text-sm leading-relaxed text-np-text-muted" data-edit="partenaires.contact.promise.text" data-type="text"><?= e(t('partenaires.contact.promise.text', 'Les informations transmises sont utilisées uniquement pour examiner votre proposition et vous recontacter.')) ?></p>
          </div>
        </div>
        <div class="rounded-2xl border border-np-border bg-np-surface p-6 shadow-xl sm:p-8 lg:col-span-3">
          <form action="/api/contact-submit" method="POST" id="partnership-contact-form" class="space-y-5" data-ajax="true">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <input type="hidden" name="ts_token" value="<?= e(generate_form_token()) ?>">
            <input type="hidden" name="request_type" value="partenariat">
            <div class="absolute -left-[9999px] top-auto h-px w-px overflow-hidden" aria-hidden="true">
              <label for="partner_website">Laisser ce champ vide</label>
              <input type="text" id="partner_website" name="website_url" tabindex="-1" autocomplete="off">
            </div>
            <div class="grid gap-5 sm:grid-cols-2">
              <div>
                <label for="partner_company" class="form-label"><span data-edit="partenaires.contact.label.company" data-type="text"><?= e(t('partenaires.contact.label.company', 'Nom de l’entreprise')) ?></span> <span class="text-np-accent">*</span></label>
                <input type="text" id="partner_company" name="company" required maxlength="160" autocomplete="organization" placeholder="Ex. Société industrielle" class="form-input">
              </div>
              <div>
                <label for="partner_sector" class="form-label"><span data-edit="partenaires.contact.label.sector" data-type="text"><?= e(t('partenaires.contact.label.sector', 'Secteur d’activité')) ?></span> <span class="text-np-accent">*</span></label>
                <input type="text" id="partner_sector" name="sector" required maxlength="160" autocomplete="organization-title" placeholder="Ex. Métallurgie, investissement..." class="form-input">
              </div>
              <div>
                <label for="partner_name" class="form-label"><span data-edit="partenaires.contact.label.name" data-type="text"><?= e(t('partenaires.contact.label.name', 'Nom du contact')) ?></span> <span class="text-np-accent">*</span></label>
                <input type="text" id="partner_name" name="name" required maxlength="120" autocomplete="name" placeholder="Votre nom et prénom" class="form-input">
              </div>
              <div>
                <label for="partner_email" class="form-label"><span data-edit="partenaires.contact.label.email" data-type="text"><?= e(t('partenaires.contact.label.email', 'Adresse e-mail professionnelle')) ?></span> <span class="text-np-accent">*</span></label>
                <input type="email" id="partner_email" name="email" required maxlength="160" autocomplete="email" placeholder="vous@entreprise.com" class="form-input">
              </div>
              <div>
                <label for="partner_phone" class="form-label" data-edit="partenaires.contact.label.phone" data-type="text"><?= e(t('partenaires.contact.label.phone', 'Téléphone (facultatif)')) ?></label>
                <input type="tel" id="partner_phone" name="phone" maxlength="40" autocomplete="tel" placeholder="+33 ..." class="form-input">
              </div>
              <div>
                <label for="partner_type" class="form-label"><span data-edit="partenaires.contact.label.type" data-type="text"><?= e(t('partenaires.contact.label.type', 'Type de partenariat envisagé')) ?></span> <span class="text-np-accent">*</span></label>
                <select id="partner_type" name="service" required class="form-input">
                  <option value="" selected disabled>Choisir une option</option>
                  <option value="Financement ou acquisition de machines et équipements">Financement ou acquisition d’équipements</option>
                  <option value="Partenariat industriel et moyens de production">Partenariat industriel / moyens de production</option>
                  <option value="Atelier de prototypage en France">Atelier de prototypage en France</option>
                  <option value="Unité de production en Tunisie">Unité de production en Tunisie</option>
                  <option value="Partenariat commercial et développement de produits">Partenariat commercial / nouveaux produits</option>
                  <option value="Autre">Autre</option>
                </select>
              </div>
            </div>
            <div>
              <label for="partner_message" class="form-label"><span data-edit="partenaires.contact.label.message" data-type="text"><?= e(t('partenaires.contact.label.message', 'Votre proposition et vos moyens')) ?></span> <span class="text-np-accent">*</span></label>
              <textarea id="partner_message" name="message" rows="5" required minlength="20" placeholder="Présentez votre proposition, vos moyens ou les pistes de collaboration que vous souhaitez explorer..." class="form-textarea w-full resize-y"></textarea>
              <p class="mt-1.5 text-xs text-np-text-muted" data-edit="partenaires.contact.message.note" data-type="text"><?= e(t('partenaires.contact.message.note', 'Décrivez votre proposition en au moins 20 caractères.')) ?></p>
            </div>
            <div class="flex items-start gap-3">
              <input type="checkbox" id="partner_rgpd" name="rgpd" value="1" required class="mt-1 h-4 w-4 rounded border-np-border text-np-accent focus:ring-np-accent">
              <label for="partner_rgpd" class="text-xs leading-relaxed text-np-text-muted" data-edit="partenaires.contact.consent" data-type="text">
                <?= e(t('partenaires.contact.consent', 'J’accepte que NOVA PRESTIGE utilise ces informations uniquement pour étudier ma proposition et me recontacter.')) ?>
              </label>
            </div>
            <button type="submit" class="inline-flex w-full items-center justify-center gap-3 rounded-lg bg-np-accent px-6 py-4 text-center text-sm font-bold text-white shadow-lg transition hover:bg-np-accent/90 disabled:pointer-events-none disabled:opacity-50 sm:w-auto">
              <span data-edit="partenaires.contact.button" data-type="text"><?= e(t('partenaires.contact.button', 'DEVENIR PARTENAIRE – ÉTUDIONS ENSEMBLE NOTRE COLLABORATION')) ?></span>
              <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>
</body>
</html>
