<?php
/**
 * Dynamic JSON-LD structured data generator.
 * Variables expected: $page_key, $seo_data
 */
$phone = function_exists('setting') ? setting('phone') : '';
$email = function_exists('setting') ? setting('contact_email') : '';
$city = function_exists('setting') ? setting('city') : '';
$address = function_exists('setting') ? setting('address') : '';
$linkedin = function_exists('setting') ? setting('linkedin') : '';

$siteUrl = url('/');

// 1. Organization & ProfessionalService
$org = [
    '@context' => 'https://schema.org',
    '@type' => ['Organization', 'ProfessionalService'],
    '@id' => $siteUrl . '#organization',
    'name' => 'NOVA PRESTIGE',
    'url' => $siteUrl,
    'logo' => url('/assets/img/favicon-512.png'),
    'description' => "Bureau d'études techniques, conseil industriel et formation spécialisé en construction métallique, façades, tôlerie et industrialisation.",
    'founder' => [
        '@type' => 'Person',
        'name' => 'Ali Nouiri',
        'jobTitle' => 'Consultant technique senior & fondateur'
    ],
    'areaServed' => [
        ['@type' => 'Country', 'name' => 'France'],
        ['@type' => 'Country', 'name' => 'Tunisie'],
        ['@type' => 'AdministrativeArea', 'name' => 'Maghreb']
    ],
    'serviceType' => [
        "Bureau d'études et faisabilité",
        "Prototypes et développement de produits",
        "Façades métalliques, bardage et calepinage",
        "Méthodes et industrialisation",
        "Conseil industriel et équipements",
        "Formation technique sur site"
    ],
    'knowsAbout' => [
        "Construction métallique",
        "Tôlerie industrielle",
        "Pliage et poinçonnage",
        "Calepinage de façades",
        "Industrialisation",
        "Méthodes de fabrication"
    ]
];

if (!empty($phone)) {
    $org['telephone'] = $phone;
}
if (!empty($email)) {
    $org['email'] = $email;
}
if (!empty($city) || !empty($address)) {
    $org['address'] = [
        '@type' => 'PostalAddress',
        'addressLocality' => !empty($city) ? $city : 'France',
        'streetAddress' => !empty($address) ? $address : ''
    ];
}
if (!empty($linkedin)) {
    $org['sameAs'] = [$linkedin];
}

// 2. WebSite
$website = [
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    '@id' => $siteUrl . '#website',
    'url' => $siteUrl,
    'name' => 'NOVA PRESTIGE',
    'description' => "Bureau d'études techniques, conseil industriel et formation",
    'publisher' => ['@id' => $siteUrl . '#organization'],
    'inLanguage' => 'fr-FR'
];

$schemas = [$org, $website];

// 3. Home FAQ
if (isset($page_key) && $page_key === 'home') {
    $faqItems = [
        [
            'q' => t('home.faq.q1', 'Intervenez-vous sur site ou à distance ?'),
            'a' => t('home.faq.a1', 'Les deux, selon la mission. Les modalités et déplacements sont définis avec vous avant le démarrage.')
        ],
        [
            'q' => t('home.faq.q2', 'NOVA PRESTIGE fabrique-t-elle les pièces ou les prototypes ?'),
            'a' => t('home.faq.a2', 'Non : NOVA PRESTIGE est un bureau d\'études et de conseil. La fabrication physique est organisée avec vos moyens ou ceux de vos partenaires.')
        ],
        [
            'q' => t('home.faq.q3', 'Quels types de formation proposez-vous ?'),
            'a' => t('home.faq.a3', 'Des interventions pratiques en atelier sur le pliage industriel, le poinçonnage, les méthodes de fabrication, la faisabilité et le développement de produits. Le programme est construit avec vous.')
        ],
        [
            'q' => t('home.faq.q4', 'Comment démarrer une mission ?'),
            'a' => t('home.faq.a4', 'Décrivez votre besoin via le formulaire de contact. Un premier échange permet de définir le périmètre, les livrables et les modalités.')
        ],
        [
            'q' => t('home.faq.q5', 'Pour quelles entreprises travaillez-vous ?'),
            'a' => t('home.faq.a5', 'Des entreprises industrielles de la construction métallique, de la façade, de la tôlerie et de la fabrication, en France, en Tunisie et au Maghreb.')
        ],
    ];

    $mainEntity = [];
    foreach ($faqItems as $item) {
        $mainEntity[] = [
            '@type' => 'Question',
            'name' => $item['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $item['a']
            ]
        ];
    }

    $schemas[] = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $mainEntity
    ];
}

// 4. BreadcrumbList for other pages
if (isset($page_key) && $page_key !== 'home' && !empty($seo_data['title'])) {
    $schemas[] = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Accueil',
                'item' => $siteUrl
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $seo_data['title'],
                'item' => $seo_data['canonical'] ?? url('/' . $page_key)
            ]
        ]
    ];
}

foreach ($schemas as $schema) {
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "</script>\n";
}
