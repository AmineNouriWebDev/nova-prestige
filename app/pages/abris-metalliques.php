<?php
declare(strict_types=1);

$page_key = 'abris-metalliques-sur-mesure';
$seo_data = function_exists('seo') ? seo($page_key) : [
    'title' => 'Abris et constructions métalliques sur mesure | NOVA PRESTIGE',
    'description' => 'Abris de jardin, ateliers, locaux techniques, bureaux et studios de jardin métalliques sur mesure. Étude et accompagnement partout en France.',
    'canonical' => url('/abris-metalliques-sur-mesure')
];
$publicPhoneFallback = (string)($_ENV['CONTACT_PHONE'] ?? '');
$publicPhone = function_exists('setting') ? setting('phone', $publicPhoneFallback) : $publicPhoneFallback;
$publicPhoneDisplay = function_exists('setting') ? setting('phone_display', $publicPhone) : $publicPhone;
$publicEmail = function_exists('setting') ? setting('contact_email') : '';
if ($publicEmail === '' || in_array(strtolower($publicEmail), ['à compléter', 'a completer'], true)) {
    $publicEmail = (string)($_ENV['CONTACT_EMAIL'] ?? 'contact@novaprestige.fr');
}
$heroImage = img('abris.hero.image', '/assets/img/abri5.jpeg', 'Illustration d’un studio de jardin métallique anthracite avec finition aspect bois et grandes baies vitrées');

$galleryItems = [
    ['abri5.jpeg', 'Studio de jardin anthracite avec finition aspect bois et grandes ouvertures vitrées.'],
    ['abri1.jpeg', 'Abri métallique anthracite avec habillage aspect bois et ouverture vitrée.'],
    ['abri2.jpeg', 'Abri de rangement métallique avec doubles portes et aménagement intérieur.'],
    ['abri3.jpeg', 'Local technique métallique clair avec porte et grandes ouvertures.'],
    ['abri4.jpeg', 'Studio de jardin contemporain anthracite avec façade vitrée et finition décorative.'],
    ['abri6.webp', 'Intérieur de construction métallique isolée, éclairée et prête à aménager.'],
    ['abri7.webp', 'Atelier métallique avec doubles portes et espace de rangement.'],
    ['abri8.webp', 'Abri métallique avec bardage décoratif aspect bois et structure anthracite.'],
];

include __DIR__ . '/../partials/head.php';
?>
<body class="bg-np-bg text-np-text font-inter antialiased selection:bg-np-accent selection:text-white" <?= function_exists('is_admin') && is_admin() ? 'data-admin="1"' : '' ?> data-page="<?= e($page_key) ?>" id="top">
  <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 rounded-md bg-np-accent px-5 py-2.5 font-medium text-white shadow-xl">Aller au contenu principal</a>
  <?php include __DIR__ . '/../partials/header.php'; ?>

  <main id="main-content">
    <section class="relative isolate overflow-hidden bg-np-primary text-white" aria-labelledby="abris-title">
      <div class="absolute inset-0 -z-10">
        <img src="<?= e($heroImage['src']) ?>" alt="<?= e($heroImage['alt']) ?>" class="h-full w-full object-cover object-center opacity-30" fetchpriority="high" data-edit="abris.hero.image" data-type="image">
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-r from-np-primary via-np-primary/90 to-np-primary/55"></div>
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-np-primary/80 via-transparent to-transparent"></div>
      </div>
      <div class="container mx-auto px-4 pb-20 pt-16 sm:px-6 sm:pb-24 lg:px-8 lg:pb-28 lg:pt-20">
        <nav class="mb-10 flex items-center gap-2 text-xs font-mono text-blue-100/70" aria-label="Fil d'Ariane">
          <a href="/" class="transition hover:text-white">Accueil</a>
          <span aria-hidden="true">/</span>
          <span class="text-np-accent">Abris sur mesure</span>
        </nav>
        <div class="max-w-4xl">
          <p class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 font-mono text-xs font-semibold uppercase tracking-widest text-np-accent" data-edit="abris.hero.eyebrow" data-type="text">
            <?= e(t('abris.hero.eyebrow', 'Une offre dédiée aux particuliers')) ?>
          </p>
          <h1 id="abris-title" class="mb-6 font-grotesk text-3xl font-bold leading-tight tracking-tight sm:text-4xl lg:text-6xl" data-edit="abris.hero.title" data-type="text">
            <?= e(t('abris.hero.title', 'ABRIS ET CONSTRUCTIONS MÉTALLIQUES SUR MESURE')) ?>
          </h1>
          <p class="max-w-3xl text-lg leading-relaxed text-blue-100 sm:text-xl" data-edit="abris.hero.lead" data-type="text">
            <?= e(t('abris.hero.lead', 'Votre projet, vos dimensions, vos finitions. NOVA PRESTIGE vous accompagne de la conception à la réalisation de votre abri métallique sur mesure.')) ?>
          </p>
          <div class="mt-8 flex flex-wrap gap-3">
            <a href="#form-etude" class="inline-flex items-center justify-center gap-2 rounded-lg bg-np-accent px-6 py-4 text-sm font-bold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-np-accent/90">
              <span data-edit="abris.hero.study_cta" data-type="text"><?= e(t('abris.hero.study_cta', 'Demander une étude')) ?></span>
              <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <a href="#form-devis" class="inline-flex items-center justify-center rounded-lg border border-white/70 px-6 py-4 text-sm font-semibold text-white transition hover:bg-white hover:text-np-primary">
              <span data-edit="abris.hero.quote_cta" data-type="text"><?= e(t('abris.hero.quote_cta', 'Demander un devis')) ?></span>
            </a>
          </div>
          <p class="mt-6 max-w-3xl text-xs leading-relaxed text-blue-100/80" data-edit="abris.hero.disclaimer" data-type="text">
            <?= e(t('abris.hero.disclaimer', 'Les images présentées illustrent des modèles et possibilités de conception ; elles ne constituent pas des réalisations déjà effectuées par NOVA PRESTIGE.')) ?>
          </p>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24" aria-labelledby="offer-title">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-10 max-w-3xl text-center">
          <p class="label-tech mb-3">DES SOLUTIONS ADAPTÉES À VOTRE USAGE</p>
          <h2 id="offer-title" class="mb-4 font-grotesk text-3xl font-bold sm:text-4xl" data-edit="abris.offer.title" data-type="text"><?= e(t('abris.offer.title', 'Un projet unique, plusieurs possibilités')) ?></h2>
          <p class="leading-relaxed text-np-text-muted" data-edit="abris.offer.intro" data-type="text"><?= e(t('abris.offer.intro', 'Du simple espace de rangement au studio de jardin, chaque configuration est étudiée selon votre besoin, votre terrain et votre budget.')) ?></p>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <?php
          $offerItems = [
              ['garden', 'Abris de jardin métalliques'],
              ['insulated', 'Abris isolés ou non isolés'],
              ['workshop', 'Ateliers et locaux de rangement'],
              ['pool', 'Locaux techniques pour piscine'],
              ['office', 'Bureaux et studios de jardin'],
              ['cladding', 'Habillages et finitions en acier laqué et aluminium'],
              ['custom', 'Constructions entièrement personnalisées'],
          ];
          foreach ($offerItems as [$key, $label]):
          ?>
          <article class="flex items-start gap-3 rounded-xl border border-np-border bg-np-surface p-5 shadow-sm transition hover:border-np-accent/50 hover:shadow-md">
            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-np-accent/10 text-np-accent" aria-hidden="true">✓</span>
            <h3 class="font-grotesk font-semibold leading-snug" data-edit="abris.offer.<?= e($key) ?>" data-type="text"><?= e(t('abris.offer.' . $key, $label)) ?></h3>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="border-y border-np-border bg-np-surface/60 py-16 sm:py-20 lg:py-24" aria-labelledby="presentation-title">
      <div class="container mx-auto grid gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:items-center lg:px-8">
        <div class="lg:col-span-6">
          <p class="label-tech mb-3">UN ACCOMPAGNEMENT DE BOUT EN BOUT</p>
          <h2 id="presentation-title" class="mb-6 font-grotesk text-3xl font-bold sm:text-4xl" data-edit="abris.presentation.title" data-type="text"><?= e(t('abris.presentation.title', 'Votre projet, vos dimensions, vos finitions.')) ?></h2>
          <div class="space-y-4 text-base leading-relaxed text-np-text-muted">
            <p data-edit="abris.presentation.text1" data-type="text"><?= e(t('abris.presentation.text1', 'NOVA PRESTIGE vous accompagne de la conception à la réalisation de votre abri métallique sur mesure.')) ?></p>
            <p data-edit="abris.presentation.text2" data-type="text"><?= e(t('abris.presentation.text2', 'Nous étudions votre besoin, réalisons les plans, vous conseillons sur les matériaux et les finitions, puis coordonnons les différentes étapes de fabrication et de réalisation avec nos partenaires spécialisés.')) ?></p>
            <p data-edit="abris.presentation.text3" data-type="text"><?= e(t('abris.presentation.text3', 'Notre objectif : proposer une solution personnalisée, adaptée à votre terrain, à vos besoins et à votre budget.')) ?></p>
            <p data-edit="abris.presentation.text4" data-type="text"><?= e(t('abris.presentation.text4', 'Avec plus de 40 ans d’expérience dans la métallurgie, le pliage et les façades métalliques, nous mettons notre savoir-faire technique au service de vos projets.')) ?></p>
          </div>
        </div>
        <div class="lg:col-span-6">
          <?php $presentationImage = img('abris.presentation.image', '/assets/img/abri5.jpeg', 'Illustration de studio de jardin métallique sur mesure'); ?>
          <div class="relative overflow-hidden rounded-2xl border border-np-border bg-np-bg shadow-xl">
            <img src="<?= e($presentationImage['src']) ?>" alt="<?= e($presentationImage['alt']) ?>" class="aspect-[4/3] w-full object-contain" loading="lazy" decoding="async" data-edit="abris.presentation.image" data-type="image">
            <div class="pointer-events-none absolute inset-x-0 bottom-0 bg-gradient-to-t from-np-primary/90 to-transparent px-5 pb-5 pt-14 text-white">
              <p class="text-xs font-mono uppercase tracking-wider text-blue-100" data-edit="abris.presentation.image_caption" data-type="text"><?= e(t('abris.presentation.image_caption', 'Illustration d’un modèle possible — conception personnalisable')) ?></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24" aria-labelledby="gallery-title">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-10 max-w-3xl text-center">
          <p class="label-tech mb-3">INSPIRATIONS ET CONFIGURATIONS</p>
          <h2 id="gallery-title" class="mb-4 font-grotesk text-3xl font-bold sm:text-4xl" data-edit="abris.gallery.title" data-type="text"><?= e(t('abris.gallery.title', 'Des modèles pour imaginer le vôtre')) ?></h2>
          <p class="leading-relaxed text-np-text-muted" data-edit="abris.gallery.intro" data-type="text"><?= e(t('abris.gallery.intro', 'Découvrez différentes formes, finitions et aménagements. Les dimensions, ouvertures, isolations et habillages peuvent être étudiés selon votre projet.')) ?></p>
        </div>
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
          <?php foreach ($galleryItems as $index => [$filename, $caption]):
            $imageKey = 'abris.gallery.image' . ($index + 1);
            $captionKey = 'abris.gallery.caption' . ($index + 1);
            $imageData = img($imageKey, '/assets/img/' . $filename, $caption);
          ?>
          <figure class="group overflow-hidden rounded-xl border border-np-border bg-np-surface shadow-sm">
            <div class="relative flex aspect-[4/3] items-center justify-center overflow-hidden bg-np-bg">
              <img src="<?= e($imageData['src']) ?>" alt="<?= e($imageData['alt']) ?>" class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-[1.03]" loading="<?= $index === 0 ? 'eager' : 'lazy' ?>" decoding="async" data-edit="<?= e($imageKey) ?>" data-type="image">
            </div>
            <figcaption class="p-4">
              <p class="mb-2 text-[10px] font-mono font-semibold uppercase tracking-widest text-np-accent">MODÈLE <?= str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT) ?></p>
              <p class="text-sm leading-relaxed text-np-text-muted" data-edit="<?= e($captionKey) ?>" data-type="text"><?= e(t($captionKey, $caption)) ?></p>
            </figcaption>
          </figure>
          <?php endforeach; ?>
        </div>
        <p class="mt-6 rounded-lg border border-np-accent/20 bg-np-accent/5 p-4 text-center text-sm leading-relaxed text-np-text-muted" data-edit="abris.gallery.disclaimer" data-type="text">
          <?= e(t('abris.gallery.disclaimer', 'Photos présentées à titre d’illustration de modèles possibles. Elles ne représentent pas des réalisations de NOVA PRESTIGE. Chaque projet est étudié et défini sur mesure.')) ?>
        </p>
      </div>
    </section>

    <section class="border-y border-np-border bg-np-surface/60 py-16 sm:py-20 lg:py-24" aria-labelledby="steps-title">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-10 max-w-3xl text-center">
          <p class="label-tech mb-3">DE L’IDÉE AU PROJET RÉALISÉ</p>
          <h2 id="steps-title" class="mb-4 font-grotesk text-3xl font-bold sm:text-4xl" data-edit="abris.steps.title" data-type="text"><?= e(t('abris.steps.title', 'Un accompagnement à chaque étape')) ?></h2>
          <p class="leading-relaxed text-np-text-muted" data-edit="abris.steps.intro" data-type="text"><?= e(t('abris.steps.intro', 'Nous clarifions votre besoin, préparons les choix techniques et coordonnons le projet avec des partenaires spécialisés.')) ?></p>
        </div>
        <ol class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <?php
          $steps = [
              'Étude du besoin et de l’usage souhaité.',
              'Dimensions et contraintes du terrain.',
              'Conception des plans et préparation technique.',
              'Choix des matériaux, de l’isolation et des finitions.',
              'Coordination de la fabrication avec des partenaires spécialisés.',
              'Suivi du projet jusqu’à sa réalisation.',
          ];
          foreach ($steps as $index => $step):
          ?>
          <li class="rounded-xl border border-np-border bg-np-bg p-5">
            <span class="mb-3 block font-mono text-sm font-bold text-np-accent">0<?= $index + 1 ?></span>
            <p class="font-medium leading-relaxed" data-edit="abris.steps.item<?= $index + 1 ?>" data-type="text"><?= e(t('abris.steps.item' . ($index + 1), $step)) ?></p>
          </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </section>

    <section class="bg-np-primary py-14 text-white sm:py-16" aria-labelledby="coverage-title">
      <div class="container mx-auto grid gap-8 px-4 sm:px-6 lg:grid-cols-[1fr_auto] lg:items-center lg:px-8">
        <div>
          <p class="mb-3 font-mono text-xs font-semibold uppercase tracking-widest text-np-accent">ZONE D’INTERVENTION</p>
          <h2 id="coverage-title" class="mb-3 font-grotesk text-2xl font-bold sm:text-3xl" data-edit="abris.coverage.title" data-type="text"><?= e(t('abris.coverage.title', 'Des projets étudiés partout en France')) ?></h2>
          <p class="max-w-3xl leading-relaxed text-blue-100" data-edit="abris.coverage.text" data-type="text"><?= e(t('abris.coverage.text', 'NOVA PRESTIGE étudie les demandes dans toute la France, avec une priorité pour la Nouvelle-Aquitaine et les régions limitrophes.')) ?></p>
        </div>
        <div class="rounded-xl border border-white/15 bg-white/5 p-5 text-sm text-blue-50">
          <p class="mb-2 font-semibold text-white" data-edit="abris.coverage.exclusions_title" data-type="text"><?= e(t('abris.coverage.exclusions_title', 'À prévoir dans votre projet')) ?></p>
          <p class="leading-relaxed text-blue-100" data-edit="abris.coverage.exclusions_text" data-type="text"><?= e(t('abris.coverage.exclusions_text', 'Les prestations de plomberie, d’électricité et les raccordements aux réseaux ne sont pas compris.')) ?></p>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 lg:py-24" aria-labelledby="contact-title">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-10 max-w-3xl text-center">
          <p class="label-tech mb-3">PARLONS DE VOTRE PROJET</p>
          <h2 id="contact-title" class="mb-4 font-grotesk text-3xl font-bold sm:text-4xl" data-edit="abris.contact.title" data-type="text"><?= e(t('abris.contact.title', 'Étude ou devis : à vous de choisir')) ?></h2>
          <p class="leading-relaxed text-np-text-muted" data-edit="abris.contact.intro" data-type="text"><?= e(t('abris.contact.intro', 'Vous avez une première idée ou déjà des plans et des dimensions précises ? Choisissez le formulaire adapté et joignez vos documents.')) ?></p>
        </div>
        <div class="mb-12 flex flex-wrap justify-center gap-3">
          <a href="#form-etude" class="inline-flex items-center justify-center rounded-lg bg-np-accent px-6 py-3.5 text-sm font-bold text-white transition hover:bg-np-accent/90" data-edit="abris.contact.study_button" data-type="text"><?= e(t('abris.contact.study_button', 'Demander une étude')) ?></a>
          <a href="#form-devis" class="inline-flex items-center justify-center rounded-lg border border-np-accent px-6 py-3.5 text-sm font-bold text-np-accent transition hover:bg-np-accent hover:text-white" data-edit="abris.contact.quote_button" data-type="text"><?= e(t('abris.contact.quote_button', 'Demander un devis')) ?></a>
          <a href="<?= $publicPhone !== '' ? 'tel:' . e($publicPhone) : '/contact' ?>" class="inline-flex items-center justify-center rounded-lg border border-np-border px-6 py-3.5 text-sm font-semibold transition hover:border-np-accent hover:text-np-accent"><span data-edit="abris.contact.call_button" data-type="text"><?= e(t('abris.contact.call_button', 'Appeler NOVA PRESTIGE')) ?></span><?= $publicPhoneDisplay !== '' ? ' — ' . e($publicPhoneDisplay) : '' ?></a>
          <a href="mailto:<?= e($publicEmail) ?>" class="inline-flex items-center justify-center rounded-lg border border-np-border px-6 py-3.5 text-sm font-semibold transition hover:border-np-accent hover:text-np-accent"><span data-edit="abris.contact.email_button" data-type="text"><?= e(t('abris.contact.email_button', 'Envoyer un e-mail')) ?></span></a>
        </div>

        <div class="grid items-start gap-8 xl:grid-cols-2">
          <article id="form-etude" class="scroll-mt-24 rounded-2xl border border-np-border bg-np-surface p-6 shadow-lg sm:p-8">
            <div class="mb-7">
              <p class="label-tech mb-2">VOUS AVEZ UNE IDÉE OU UN PREMIER PROJET ?</p>
              <h3 class="font-grotesk text-2xl font-bold" data-edit="abris.study.title" data-type="text"><?= e(t('abris.study.title', 'DEMANDER UNE ÉTUDE')) ?></h3>
              <p class="mt-2 text-sm leading-relaxed text-np-text-muted" data-edit="abris.study.intro" data-type="text"><?= e(t('abris.study.intro', 'NOVA PRESTIGE — Votre projet sur mesure. Présentez-nous votre idée d’abri, d’atelier ou de studio de jardin ; nous étudierons votre demande et vous accompagnerons dans sa conception.')) ?></p>
            </div>
            <form action="/api/contact-submit" method="POST" id="shelter-study-form" class="space-y-5" data-ajax="true" enctype="multipart/form-data">
              <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
              <input type="hidden" name="ts_token" value="<?= e(generate_form_token()) ?>">
              <input type="hidden" name="request_type" value="abri_etude">
              <div class="absolute -left-[9999px] top-auto h-px w-px overflow-hidden" aria-hidden="true">
                <label for="study_website">Laisser ce champ vide</label>
                <input type="text" id="study_website" name="website_url" tabindex="-1" autocomplete="off">
              </div>
              <div class="grid gap-4 sm:grid-cols-2">
                <div>
                  <label for="study_name" class="form-label"><span data-edit="abris.study.label.name" data-type="text"><?= e(t('abris.study.label.name', 'Nom et prénom')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="text" id="study_name" name="name" required maxlength="120" autocomplete="name" class="form-input">
                </div>
                <div>
                  <label for="study_phone" class="form-label"><span data-edit="abris.study.label.phone" data-type="text"><?= e(t('abris.study.label.phone', 'Téléphone')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="tel" id="study_phone" name="phone" required maxlength="40" autocomplete="tel" class="form-input">
                </div>
                <div>
                  <label for="study_email" class="form-label"><span data-edit="abris.study.label.email" data-type="text"><?= e(t('abris.study.label.email', 'Adresse e-mail')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="email" id="study_email" name="email" required maxlength="160" autocomplete="email" class="form-input">
                </div>
                <div>
                  <label for="study_city" class="form-label"><span data-edit="abris.study.label.city" data-type="text"><?= e(t('abris.study.label.city', 'Ville du projet')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="text" id="study_city" name="project_city" required maxlength="120" autocomplete="address-level2" class="form-input">
                </div>
                <div>
                  <label for="study_type" class="form-label"><span data-edit="abris.study.label.type" data-type="text"><?= e(t('abris.study.label.type', 'Type d’abri souhaité')) ?></span> <span class="text-np-accent">*</span></label>
                  <select id="study_type" name="shelter_type" required class="form-input">
                    <option value="" selected disabled>Choisir une option</option>
                    <option value="Abri de jardin métallique">Abri de jardin métallique</option>
                    <option value="Atelier de jardin">Atelier de jardin</option>
                    <option value="Local technique pour piscine">Local technique pour piscine</option>
                    <option value="Bureau ou studio de jardin">Bureau ou studio de jardin</option>
                    <option value="Local de rangement">Local de rangement</option>
                    <option value="Construction métallique personnalisée">Construction personnalisée</option>
                    <option value="Autre">Autre</option>
                  </select>
                </div>
                <fieldset class="sm:col-span-2">
                  <legend class="form-label"><span data-edit="abris.study.label.dimensions" data-type="text"><?= e(t('abris.study.label.dimensions', 'Dimensions approximatives')) ?></span> <span class="text-np-accent">*</span></legend>
                  <div class="grid gap-3 sm:grid-cols-3">
                    <div>
                      <label for="study_length" class="sr-only">Longueur approximative en mètres</label>
                      <input type="number" id="study_length" name="length" required min="0.1" max="999" step="0.1" placeholder="Longueur (m)" class="form-input" aria-label="Longueur approximative en mètres">
                    </div>
                    <div>
                      <label for="study_width" class="sr-only">Largeur approximative en mètres</label>
                      <input type="number" id="study_width" name="width" required min="0.1" max="999" step="0.1" placeholder="Largeur (m)" class="form-input" aria-label="Largeur approximative en mètres">
                    </div>
                    <div>
                      <label for="study_height" class="sr-only">Hauteur approximative en mètres</label>
                      <input type="number" id="study_height" name="height" required min="0.1" max="999" step="0.1" placeholder="Hauteur (m)" class="form-input" aria-label="Hauteur approximative en mètres">
                    </div>
                  </div>
                </fieldset>
                <div>
                  <label for="study_insulation" class="form-label"><span data-edit="abris.study.label.insulation" data-type="text"><?= e(t('abris.study.label.insulation', 'Isolation souhaitée')) ?></span> <span class="text-np-accent">*</span></label>
                  <select id="study_insulation" name="insulation" required class="form-input">
                    <option value="" selected disabled>Choisir une option</option>
                    <option value="Avec isolation">Avec isolation</option>
                    <option value="Sans isolation">Sans isolation</option>
                    <option value="À définir">À définir</option>
                  </select>
                </div>
                <div>
                  <label for="study_budget" class="form-label" data-edit="abris.study.label.budget" data-type="text"><?= e(t('abris.study.label.budget', 'Budget envisagé (facultatif)')) ?></label>
                  <input type="text" id="study_budget" name="budget" maxlength="100" class="form-input">
                </div>
                <div>
                  <label for="study_deadline" class="form-label"><span data-edit="abris.study.label.deadline" data-type="text"><?= e(t('abris.study.label.deadline', 'Délai souhaité')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="text" id="study_deadline" name="deadline" required maxlength="100" placeholder="Ex. dans 6 mois, à définir..." class="form-input">
                </div>
                <div>
                  <label for="study_materials" class="form-label" data-edit="abris.study.label.materials" data-type="text"><?= e(t('abris.study.label.materials', 'Matériaux et finitions souhaités')) ?></label>
                  <select id="study_materials" name="materials" class="form-input">
                    <option value="">À définir</option>
                    <option value="Acier laqué">Acier laqué</option>
                    <option value="Aluminium">Aluminium</option>
                    <option value="Autre">Autre</option>
                  </select>
                </div>
              </div>
              <div>
                <label for="study_message" class="form-label"><span data-edit="abris.study.label.message" data-type="text"><?= e(t('abris.study.label.message', 'Parlez-nous de votre projet')) ?></span> <span class="text-np-accent">*</span></label>
                <textarea id="study_message" name="message" rows="4" required minlength="20" maxlength="5000" class="form-textarea w-full resize-y" placeholder="Votre usage, les contraintes connues du terrain ou toute autre précision utile..."></textarea>
              </div>
              <div>
                <label for="study_attachments" class="form-label" data-edit="abris.study.label.attachments" data-type="text"><?= e(t('abris.study.label.attachments', 'Photos du terrain ou croquis (facultatif)')) ?></label>
                <input type="file" id="study_attachments" name="attachments[]" multiple accept="image/jpeg,image/png,image/webp,application/pdf" class="block w-full text-sm text-np-text-muted file:mr-3 file:rounded-lg file:border-0 file:bg-np-accent/10 file:px-4 file:py-2.5 file:font-semibold file:text-np-accent hover:file:bg-np-accent/20">
                <p class="mt-1 text-xs text-np-text-muted" data-edit="abris.study.upload.note" data-type="text"><?= e(t('abris.study.upload.note', 'Jusqu’à 4 fichiers JPG, PNG, WebP ou PDF, 2 Mo maximum par fichier.')) ?></p>
              </div>
              <div class="flex items-start gap-3">
                <input type="checkbox" id="study_rgpd" name="rgpd" value="1" required class="mt-1 h-4 w-4 rounded border-np-border text-np-accent focus:ring-np-accent">
                <label for="study_rgpd" class="text-xs leading-relaxed text-np-text-muted" data-edit="abris.study.consent" data-type="text"><?= e(t('abris.study.consent', 'J’accepte que NOVA PRESTIGE utilise ces informations uniquement pour étudier mon projet et me recontacter.')) ?></label>
              </div>
              <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg bg-np-accent px-6 py-4 text-sm font-bold text-white transition hover:bg-np-accent/90 disabled:pointer-events-none disabled:opacity-50">
                <span data-edit="abris.study.submit" data-type="text"><?= e(t('abris.study.submit', 'ENVOYER MA DEMANDE D’ÉTUDE')) ?></span>
              </button>
            </form>
          </article>

          <article id="form-devis" class="scroll-mt-24 rounded-2xl border border-np-border bg-np-surface p-6 shadow-lg sm:p-8">
            <div class="mb-7">
              <p class="label-tech mb-2">VOUS AVEZ DÉJÀ DES DIMENSIONS OU DES PLANS ?</p>
              <h3 class="font-grotesk text-2xl font-bold" data-edit="abris.quote.title" data-type="text"><?= e(t('abris.quote.title', 'DEMANDER UN DEVIS')) ?></h3>
              <p class="mt-2 text-sm leading-relaxed text-np-text-muted" data-edit="abris.quote.intro" data-type="text"><?= e(t('abris.quote.intro', 'NOVA PRESTIGE — Étude de votre projet. Votre projet est déjà défini ? Transmettez-nous les informations nécessaires pour préparer une proposition adaptée.')) ?></p>
            </div>
            <form action="/api/contact-submit" method="POST" id="shelter-quote-form" class="space-y-5" data-ajax="true" enctype="multipart/form-data">
              <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
              <input type="hidden" name="ts_token" value="<?= e(generate_form_token()) ?>">
              <input type="hidden" name="request_type" value="abri_devis">
              <div class="absolute -left-[9999px] top-auto h-px w-px overflow-hidden" aria-hidden="true">
                <label for="quote_website">Laisser ce champ vide</label>
                <input type="text" id="quote_website" name="website_url" tabindex="-1" autocomplete="off">
              </div>
              <div class="grid gap-4 sm:grid-cols-2">
                <div>
                  <label for="quote_name" class="form-label"><span data-edit="abris.quote.label.name" data-type="text"><?= e(t('abris.quote.label.name', 'Nom et prénom')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="text" id="quote_name" name="name" required maxlength="120" autocomplete="name" class="form-input">
                </div>
                <div>
                  <label for="quote_phone" class="form-label"><span data-edit="abris.quote.label.phone" data-type="text"><?= e(t('abris.quote.label.phone', 'Téléphone')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="tel" id="quote_phone" name="phone" required maxlength="40" autocomplete="tel" class="form-input">
                </div>
                <div>
                  <label for="quote_email" class="form-label"><span data-edit="abris.quote.label.email" data-type="text"><?= e(t('abris.quote.label.email', 'Adresse e-mail')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="email" id="quote_email" name="email" required maxlength="160" autocomplete="email" class="form-input">
                </div>
                <div>
                  <label for="quote_city" class="form-label"><span data-edit="abris.quote.label.city" data-type="text"><?= e(t('abris.quote.label.city', 'Ville du chantier')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="text" id="quote_city" name="project_city" required maxlength="120" autocomplete="address-level2" class="form-input">
                </div>
                <div class="sm:col-span-2">
                  <label for="quote_address" class="form-label"><span data-edit="abris.quote.label.address" data-type="text"><?= e(t('abris.quote.label.address', 'Adresse du chantier')) ?></span> <span class="text-np-accent">*</span></label>
                  <input type="text" id="quote_address" name="site_address" required maxlength="240" autocomplete="street-address" class="form-input">
                </div>
                <div>
                  <label for="quote_type" class="form-label"><span data-edit="abris.quote.label.type" data-type="text"><?= e(t('abris.quote.label.type', 'Type de construction')) ?></span> <span class="text-np-accent">*</span></label>
                  <select id="quote_type" name="shelter_type" required class="form-input">
                    <option value="" selected disabled>Choisir une option</option>
                    <option value="Abri de jardin métallique">Abri de jardin métallique</option>
                    <option value="Atelier de jardin">Atelier de jardin</option>
                    <option value="Local technique pour piscine">Local technique pour piscine</option>
                    <option value="Bureau ou studio de jardin">Bureau ou studio de jardin</option>
                    <option value="Local de rangement">Local de rangement</option>
                    <option value="Construction métallique personnalisée">Construction personnalisée</option>
                    <option value="Autre">Autre</option>
                  </select>
                </div>
                <div>
                  <label for="quote_length" class="form-label">Longueur (m) <span class="text-np-accent">*</span></label>
                  <input type="number" id="quote_length" name="length" required min="0.1" max="999" step="0.1" class="form-input">
                </div>
                <div>
                  <label for="quote_width" class="form-label">Largeur (m) <span class="text-np-accent">*</span></label>
                  <input type="number" id="quote_width" name="width" required min="0.1" max="999" step="0.1" class="form-input">
                </div>
                <div>
                  <label for="quote_height" class="form-label">Hauteur (m) <span class="text-np-accent">*</span></label>
                  <input type="number" id="quote_height" name="height" required min="0.1" max="999" step="0.1" class="form-input">
                </div>
                <div>
                  <label for="quote_surface" class="form-label">Surface approximative (m²)</label>
                  <input type="number" id="quote_surface" name="surface" min="0.1" max="9999" step="0.1" class="form-input">
                </div>
                <div>
                  <label for="quote_insulation" class="form-label"><span data-edit="abris.quote.label.insulation" data-type="text"><?= e(t('abris.quote.label.insulation', 'Isolation souhaitée')) ?></span> <span class="text-np-accent">*</span></label>
                  <select id="quote_insulation" name="insulation" required class="form-input">
                    <option value="" selected disabled>Choisir une option</option>
                    <option value="Avec isolation">Avec isolation</option>
                    <option value="Sans isolation">Sans isolation</option>
                  </select>
                </div>
                <div>
                  <label for="quote_materials" class="form-label"><span data-edit="abris.quote.label.materials" data-type="text"><?= e(t('abris.quote.label.materials', 'Matériaux et finitions')) ?></span> <span class="text-np-accent">*</span></label>
                  <select id="quote_materials" name="materials" required class="form-input">
                    <option value="" selected disabled>Choisir un matériau</option>
                    <option value="Acier laqué">Acier laqué</option>
                    <option value="Panneaux sandwich">Panneaux sandwich</option>
                    <option value="Aluminium">Aluminium</option>
                    <option value="Autre">Autre</option>
                  </select>
                </div>
                <div>
                  <label for="quote_roof_type" class="form-label">Type de toiture <span class="text-np-accent">*</span></label>
                  <select id="quote_roof_type" name="roof_type" required class="form-input">
                    <option value="" selected disabled>Choisir une option</option>
                    <option value="Toiture plate">Toiture plate</option>
                    <option value="Toiture monopente">Toiture monopente</option>
                    <option value="Toiture deux pentes">Toiture deux pentes</option>
                    <option value="Autre ou à définir">Autre ou à définir</option>
                  </select>
                </div>
                <div>
                  <label for="quote_finish_color" class="form-label">Couleur ou finition souhaitée</label>
                  <input type="text" id="quote_finish_color" name="finish_color" maxlength="120" placeholder="Ex. RAL 7016, aspect bois..." class="form-input">
                </div>
                <div>
                  <label for="quote_deadline" class="form-label">Réalisation souhaitée pour</label>
                  <input type="text" id="quote_deadline" name="deadline" maxlength="100" placeholder="Ex. automne 2026" class="form-input">
                </div>
                <div>
                  <label for="quote_budget" class="form-label">Budget envisagé (facultatif)</label>
                  <input type="text" id="quote_budget" name="budget" maxlength="100" class="form-input">
                </div>
              </div>
              <div>
                <label for="quote_message" class="form-label"><span data-edit="abris.quote.label.message" data-type="text"><?= e(t('abris.quote.label.message', 'Description du projet')) ?></span> <span class="text-np-accent">*</span></label>
                <textarea id="quote_message" name="message" rows="5" required minlength="20" maxlength="5000" class="form-textarea w-full resize-y" placeholder="Usage prévu, configuration, ouvertures, contraintes et finitions souhaitées..."></textarea>
              </div>
              <div>
                <label for="quote_attachments" class="form-label" data-edit="abris.quote.label.attachments" data-type="text"><?= e(t('abris.quote.label.attachments', 'Plans, croquis et photos (facultatif)')) ?></label>
                <input type="file" id="quote_attachments" name="attachments[]" multiple accept="image/jpeg,image/png,image/webp,application/pdf" class="block w-full text-sm text-np-text-muted file:mr-3 file:rounded-lg file:border-0 file:bg-np-accent/10 file:px-4 file:py-2.5 file:font-semibold file:text-np-accent hover:file:bg-np-accent/20">
                <p class="mt-1 text-xs text-np-text-muted" data-edit="abris.quote.upload.note" data-type="text"><?= e(t('abris.quote.upload.note', 'Jusqu’à 4 fichiers JPG, PNG, WebP ou PDF, 2 Mo maximum par fichier.')) ?></p>
              </div>
              <div class="flex items-start gap-3">
                <input type="checkbox" id="quote_rgpd" name="rgpd" value="1" required class="mt-1 h-4 w-4 rounded border-np-border text-np-accent focus:ring-np-accent">
                <label for="quote_rgpd" class="text-xs leading-relaxed text-np-text-muted" data-edit="abris.quote.consent" data-type="text"><?= e(t('abris.quote.consent', 'J’accepte que NOVA PRESTIGE utilise ces informations uniquement pour étudier ma demande de devis et me recontacter.')) ?></label>
              </div>
              <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg bg-np-accent px-6 py-4 text-sm font-bold text-white transition hover:bg-np-accent/90 disabled:pointer-events-none disabled:opacity-50">
                <span data-edit="abris.quote.submit" data-type="text"><?= e(t('abris.quote.submit', 'ENVOYER MA DEMANDE DE DEVIS')) ?></span>
              </button>
            </form>
          </article>
        </div>
        <p class="mx-auto mt-8 max-w-4xl text-center text-xs leading-relaxed text-np-text-muted" data-edit="abris.terms" data-type="text">
          <?= e(t('abris.terms', 'Les projets sont définis sur mesure après étude. Les prestations de plomberie, d’électricité et les raccordements aux réseaux ne sont pas compris.')) ?>
        </p>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  <?php include __DIR__ . '/../partials/mobile-bar.php'; ?>
</body>
</html>
