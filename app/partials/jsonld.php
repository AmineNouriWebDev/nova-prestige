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
$logoUrl = url('/assets/img/favicon-512.png');
$pageUrl = $seo_data['canonical'] ?? $siteUrl;

$organization = [
    '@type' => ['Organization', 'ProfessionalService'],
    '@id' => $siteUrl . '#organization',
    'name' => 'NOVA PRESTIGE',
    'url' => $siteUrl,
    'logo' => [
        '@type' => 'ImageObject',
        '@id' => $siteUrl . '#logo',
        'url' => $logoUrl,
        'contentUrl' => $logoUrl,
        'width' => 512,
        'height' => 512,
    ],
    'description' => "Bureau d'études techniques, conseil industriel et formation spécialisé en construction métallique, façades, tôlerie et industrialisation.",
    'founder' => [
        '@type' => 'Person',
        'name' => 'Ali Nouiri',
        'jobTitle' => 'Consultant technique senior & fondateur',
    ],
    'areaServed' => [
        ['@type' => 'Country', 'name' => 'France'],
        ['@type' => 'Country', 'name' => 'Tunisie'],
        ['@type' => 'AdministrativeArea', 'name' => 'Maghreb'],
    ],
    'knowsAbout' => [
        'Construction métallique',
        'Tôlerie industrielle',
        'Pliage et poinçonnage',
        'Calepinage de façades',
        'Industrialisation',
        'Méthodes de fabrication',
    ],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => 'Expertises NOVA PRESTIGE',
        'itemListElement' => array_map(
            static fn (string $service): array => [
                '@type' => 'Offer',
                'itemOffered' => [
                    '@type' => 'Service',
                    'name' => $service,
                ],
            ],
            [
                "Bureau d'études et faisabilité",
                'Prototypes et développement de produits',
                'Façades métalliques, bardage et calepinage',
                'Méthodes et industrialisation',
                'Conseil industriel et équipements',
                'Formation technique sur site',
            ]
        ),
    ],
];

if ($phone !== '') {
    $organization['telephone'] = $phone;
}
if ($email !== '') {
    $organization['email'] = $email;
}
if ($city !== '' || $address !== '') {
    $postalAddress = ['@type' => 'PostalAddress'];
    if ($city !== '') {
        $postalAddress['addressLocality'] = $city;
    }
    if ($address !== '') {
        $postalAddress['streetAddress'] = $address;
    }
    $organization['address'] = $postalAddress;
}
if ($linkedin !== '') {
    $organization['sameAs'] = [$linkedin];
}

$website = [
    '@type' => 'WebSite',
    '@id' => $siteUrl . '#website',
    'url' => $siteUrl,
    'name' => 'NOVA PRESTIGE',
    'description' => "Bureau d'études techniques, conseil industriel et formation",
    'publisher' => ['@id' => $siteUrl . '#organization'],
    'inLanguage' => 'fr-FR',
];

$webpage = [
    '@type' => 'WebPage',
    '@id' => $pageUrl . '#webpage',
    'url' => $pageUrl,
    'name' => $seo_data['title'] ?? 'NOVA PRESTIGE',
    'description' => $seo_data['description'] ?? '',
    'isPartOf' => ['@id' => $siteUrl . '#website'],
    'about' => ['@id' => $siteUrl . '#organization'],
    'inLanguage' => 'fr-FR',
    'primaryImageOfPage' => [
        '@type' => 'ImageObject',
        'url' => url('/assets/img/og-default.webp'),
    ],
];

$graph = [$organization, $website, $webpage];

if (isset($page_key) && $page_key === 'home') {
    $faqItems = [
        [
            'q' => t('home.faq.q1', 'Intervenez-vous sur site ou à distance ?'),
            'a' => t('home.faq.a1', 'Les deux, selon la mission. Les modalités et déplacements sont définis avec vous avant le démarrage.'),
        ],
        [
            'q' => t('home.faq.q2', 'NOVA PRESTIGE fabrique-t-elle les pièces ou les prototypes ?'),
            'a' => t('home.faq.a2', 'Non : NOVA PRESTIGE est un bureau d\'études et de conseil. La fabrication physique est organisée avec vos moyens ou ceux de vos partenaires.'),
        ],
        [
            'q' => t('home.faq.q3', 'Quels types de formation proposez-vous ?'),
            'a' => t('home.faq.a3', 'Des interventions pratiques en atelier sur le pliage industriel, le poinçonnage, les méthodes de fabrication, la faisabilité et le développement de produits. Le programme est construit avec vous.'),
        ],
        [
            'q' => t('home.faq.q4', 'Comment démarrer une mission ?'),
            'a' => t('home.faq.a4', 'Décrivez votre besoin via le formulaire de contact. Un premier échange permet de définir le périmètre, les livrables et les modalités.'),
        ],
        [
            'q' => t('home.faq.q5', 'Pour quelles entreprises travaillez-vous ?'),
            'a' => t('home.faq.a5', 'Des entreprises industrielles de la construction métallique, de la façade, de la tôlerie et de la fabrication, en France, en Tunisie et au Maghreb.'),
        ],
    ];

    $faqSchema = [
        '@type' => 'FAQPage',
        '@id' => $siteUrl . '#faq',
        'url' => $siteUrl,
        'isPartOf' => ['@id' => $siteUrl . '#website'],
        'mainEntity' => array_map(
            static fn (array $item): array => [
                '@type' => 'Question',
                'name' => $item['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $item['a'],
                ],
            ],
            $faqItems
        ),
    ];

    $webpage['mainEntity'] = ['@id' => $siteUrl . '#faq'];
    $graph[2] = $webpage;
    $graph[] = $faqSchema;
}

if (isset($page_key) && $page_key !== 'home' && !empty($seo_data['title'])) {
    $graph[] = [
        '@type' => 'BreadcrumbList',
        '@id' => $pageUrl . '#breadcrumb',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Accueil',
                'item' => $siteUrl,
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $seo_data['title'],
                'item' => $pageUrl,
            ],
        ],
    ];
}

$structuredData = [
    '@context' => 'https://schema.org',
    '@graph' => $graph,
];

echo '<script type="application/ld+json">'
    . json_encode(
        $structuredData,
        JSON_UNESCAPED_SLASHES
            | JSON_UNESCAPED_UNICODE
            | JSON_PRETTY_PRINT
            | JSON_HEX_TAG
            | JSON_HEX_AMP
            | JSON_HEX_APOS
            | JSON_HEX_QUOT
            | JSON_THROW_ON_ERROR
    )
    . "</script>\n";
