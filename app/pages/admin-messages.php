<?php
declare(strict_types=1);

if (!function_exists('is_admin') || !is_admin()) {
    header('X-Robots-Tag: noindex, nofollow');
    header('Location: /', true, 302);
    exit;
}

$page_key = 'admin-messages';
$noindex = true;
$seo_data = [
    'title' => 'Messages reçus | NOVA PRESTIGE',
    'description' => 'Boîte de réception des demandes reçues via les formulaires NOVA PRESTIGE.',
    'canonical' => url('/admin/messages'),
];

global $pdo;
$loadError = false;
$messages = [];
$unreadCount = 0;
$totalMessages = 0;
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSize = 25;

if (!$pdo instanceof PDO) {
    $loadError = true;
    http_response_code(500);
} else {
    try {
        ensure_contact_request_reads_table($pdo);
        $unreadCount = contact_request_unread_count($pdo);
        $totalMessages = (int)$pdo->query('SELECT COUNT(*) FROM contact_requests')->fetchColumn();
        $totalPages = max(1, (int)ceil($totalMessages / $pageSize));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $pageSize;

        $stmt = $pdo->prepare(
            "SELECT requests.id, requests.name, requests.company, requests.email, requests.phone,
                    requests.country, requests.service, requests.mode, requests.message, requests.request_type,
                    requests.created_at, read_state.read_at
             FROM contact_requests requests
             LEFT JOIN contact_request_reads read_state ON read_state.contact_request_id = requests.id
             ORDER BY requests.created_at DESC, requests.id DESC
             LIMIT :page_size OFFSET :page_offset"
        );
        $stmt->bindValue(':page_size', $pageSize, PDO::PARAM_INT);
        $stmt->bindValue(':page_offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
        error_log('Unable to load admin contact inbox: ' . $e->getMessage());
        $loadError = true;
        http_response_code(500);
    }
}

$totalPages = max(1, (int)ceil($totalMessages / $pageSize));
$requestLabels = [
    'projet' => 'Contact général — étude de projet',
    'devis' => 'Contact général — demande de devis',
    'contact' => 'Contact général — information',
    'partenariat' => 'Formulaire partenariat',
    'abri_etude' => 'Formulaire abris — demande d’étude',
    'abri_devis' => 'Formulaire abris — demande de devis',
];
$detailLabels = [
    'Secteur d’activité',
    'Ville du projet',
    'Type de construction',
    'Dimensions',
    'Isolation',
    'Surface approximative',
    'Matériaux et finitions',
    'Type de toiture',
    'Couleur ou finition souhaitée',
    'Budget envisagé',
    'Délai souhaité',
    'Adresse du chantier',
    'Informations complémentaires',
];

include __DIR__ . '/../partials/head.php';
?>
<body class="bg-np-bg text-np-text font-inter antialiased" data-admin="1" data-page="<?= e($page_key) ?>" id="top">
  <?php include __DIR__ . '/../partials/header.php'; ?>
  <main class="container mx-auto max-w-6xl px-4 pb-20 pt-28 sm:px-6 lg:px-8" id="main-content">
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
      <div>
        <p class="label-tech mb-2">ESPACE ADMINISTRATION</p>
        <h1 class="font-grotesk text-3xl font-bold sm:text-4xl">Messages reçus</h1>
        <p class="mt-2 text-sm text-np-text-muted">Demandes transmises depuis les formulaires du site.</p>
      </div>
      <div id="inbox-notification" class="inline-flex items-center gap-2 self-start rounded-xl border border-np-accent/30 bg-np-accent/10 px-4 py-3 text-sm font-semibold text-np-accent" role="status" aria-live="polite">
        <span aria-hidden="true">●</span>
        <span><span id="unread-count"><?= $unreadCount ?></span> message<?= $unreadCount === 1 ? '' : 's' ?> non lu<?= $unreadCount === 1 ? '' : 's' ?></span>
      </div>
    </div>

    <?php if ($loadError): ?>
      <div class="rounded-xl border border-red-300 bg-red-50 p-5 text-sm text-red-800" role="alert">
        Impossible de charger la boîte de réception. Vérifiez la connexion à la base de données et consultez les journaux du serveur.
      </div>
    <?php elseif ($messages === []): ?>
      <div class="rounded-2xl border border-np-border bg-np-surface p-8 text-center shadow-sm">
        <h2 class="font-grotesk text-xl font-semibold">Aucun message pour le moment</h2>
        <p class="mt-2 text-sm text-np-text-muted">Les demandes envoyées par les formulaires apparaîtront ici.</p>
      </div>
    <?php else: ?>
      <div class="space-y-4">
        <?php foreach ($messages as $message): ?>
          <?php
          $isRead = $message['read_at'] !== null;
          $messageId = (int)$message['id'];
          $createdAt = strtotime((string)$message['created_at']);
          $requestDetails = [];
          $attachments = [];
          $descriptionLines = [];
          $descriptionStarted = false;
          $lastDetailLabel = null;
          $storedMessage = (string)$message['message'];
          $hasDescriptionMarker = preg_match('/^Description du besoin :$/m', $storedMessage) === 1;
          foreach (explode("\n", $storedMessage) as $messageLine) {
              if (trim($messageLine) === 'Description du besoin :') {
                  $descriptionStarted = true;
                  continue;
              }
              if ($descriptionStarted) {
                  $descriptionLines[] = $messageLine;
                  continue;
              }

              if (preg_match('~^Pièce jointe : (.+?) — (https?://\S+)$~u', $messageLine, $attachmentMatch)) {
                  $attachmentUrl = $attachmentMatch[2];
                  $attachmentPath = parse_url($attachmentUrl, PHP_URL_PATH);
                  $expectedAttachmentPath = parse_url(url('/api/contact-attachment'), PHP_URL_PATH);
                  $attachmentQuery = [];
                  parse_str((string)parse_url($attachmentUrl, PHP_URL_QUERY), $attachmentQuery);
                  $storedFile = (string)($attachmentQuery['file'] ?? '');
                  if (
                      $attachmentPath === $expectedAttachmentPath
                      && preg_match('/^\d{8}_[a-f0-9]{48}\.(jpg|png|webp|pdf)$/', $storedFile)
                  ) {
                      $originalName = (string)($attachmentQuery['name'] ?? $attachmentMatch[1]);
                      $attachments[] = [
                          'name' => $originalName,
                          'url' => url('/api/contact-attachment')
                              . '?file=' . rawurlencode($storedFile)
                              . '&name=' . rawurlencode($originalName),
                      ];
                  }
                  continue;
              }

              $matchedDetail = false;
              foreach ($detailLabels as $detailLabel) {
                  $prefix = $detailLabel . ': ';
                  if (str_starts_with($messageLine, $prefix)) {
                      $requestDetails[$detailLabel] = substr($messageLine, strlen($prefix));
                      $lastDetailLabel = $detailLabel;
                      $matchedDetail = true;
                      break;
                  }
              }
              if (!$matchedDetail) {
                  if ($hasDescriptionMarker && $lastDetailLabel !== null) {
                      $requestDetails[$lastDetailLabel] .= "\n" . $messageLine;
                  } else {
                      $descriptionStarted = true;
                      $descriptionLines[] = $messageLine;
                  }
              }
          }

          if (!empty($message['country'])) {
              $requestDetails['Pays'] = (string)$message['country'];
          }
          if (!empty($message['service'])) {
              $requestDetails['Domaine d’intervention'] = (string)$message['service'];
          }
          if (!empty($message['mode'])) {
              $requestDetails['Modalité souhaitée'] = (string)$message['mode'];
          }
          $description = $hasDescriptionMarker
              ? trim(implode("\n", $descriptionLines))
              : trim($storedMessage);
          ?>
          <article id="message-<?= $messageId ?>" data-message-id="<?= $messageId ?>" data-read="<?= $isRead ? '1' : '0' ?>" class="rounded-2xl border <?= $isRead ? 'border-np-border bg-np-surface' : 'border-np-accent/50 bg-np-surface shadow-md shadow-np-accent/5' ?> p-5 sm:p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
              <div class="min-w-0">
                <div class="mb-2 flex flex-wrap items-center gap-2">
                  <span class="rounded-full bg-np-primary/10 px-3 py-1 text-xs font-semibold text-np-primary dark:text-np-primary"><?= e($requestLabels[(string)$message['request_type']] ?? 'Demande') ?></span>
                  <span data-message-status class="text-xs font-semibold <?= $isRead ? 'text-np-text-muted' : 'text-np-accent' ?>"><?= $isRead ? 'Lu' : 'Nouveau' ?></span>
                </div>
                <h2 class="truncate font-grotesk text-xl font-semibold"><?= e((string)($message['name'] ?: 'Nom non renseigné')) ?></h2>
                <p class="mt-1 break-all text-sm text-np-text-muted">
                  <a class="hover:text-np-accent" href="mailto:<?= e((string)$message['email']) ?>"><?= e((string)$message['email']) ?></a>
                  <?php if (!empty($message['phone'])): ?> · <a class="hover:text-np-accent" href="tel:<?= e((string)$message['phone']) ?>"><?= e((string)$message['phone']) ?></a><?php endif; ?>
                </p>
                <p class="mt-1 text-xs text-np-text-muted">
                  <?= $createdAt !== false ? e(date('d/m/Y à H:i', $createdAt)) : e((string)$message['created_at']) ?>
                  <?php if (!empty($message['company'])): ?> · <?= e((string)$message['company']) ?><?php endif; ?>
                </p>
              </div>
              <?php if (!$isRead): ?>
                <button type="button" data-mark-read class="shrink-0 rounded-lg border border-np-accent px-4 py-2 text-sm font-semibold text-np-accent transition hover:bg-np-accent hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-np-accent">
                  Marquer comme lu
                </button>
              <?php endif; ?>
            </div>
            <details class="mt-5 border-t border-np-border pt-4">
              <summary class="cursor-pointer text-sm font-semibold text-np-primary hover:text-np-accent dark:text-np-primary">Voir tous les détails</summary>
              <div class="mt-4 grid gap-3 text-sm sm:grid-cols-2">
                <?php foreach ($requestDetails as $detailLabel => $detailValue): ?>
                  <?php if ($detailValue !== ''): ?>
                    <p class="break-words"><strong><?= e($detailLabel) ?> :</strong> <?= nl2br(e($detailValue)) ?></p>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
              <?php if ($attachments !== []): ?>
                <div class="mt-4 rounded-xl border border-np-border bg-np-bg p-4">
                  <h3 class="text-sm font-semibold">Pièces jointes (<?= count($attachments) ?>)</h3>
                  <ul class="mt-2 space-y-2 text-sm">
                    <?php foreach ($attachments as $attachment): ?>
                      <li><a class="break-all text-np-accent underline hover:no-underline" href="<?= e($attachment['url']) ?>"><?= e($attachment['name']) ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
              <?php if ($description !== ''): ?>
                <div class="mt-4">
                  <h3 class="mb-2 text-sm font-semibold"><?= $hasDescriptionMarker ? 'Description du besoin' : 'Message reçu' ?></h3>
                  <pre class="whitespace-pre-wrap break-words rounded-xl bg-np-bg p-4 font-inter text-sm leading-relaxed text-np-text"><?= e($description) ?></pre>
                </div>
              <?php endif; ?>
            </details>
          </article>
        <?php endforeach; ?>
      </div>

      <?php if ($totalPages > 1): ?>
        <nav class="mt-8 flex items-center justify-between" aria-label="Pagination des messages">
          <?php if ($currentPage > 1): ?>
            <a class="btn-secondary px-4 py-2 text-sm" href="/admin/messages?page=<?= $currentPage - 1 ?>">← Plus récents</a>
          <?php else: ?><span></span><?php endif; ?>
          <span class="text-sm text-np-text-muted">Page <?= $currentPage ?> sur <?= $totalPages ?></span>
          <?php if ($currentPage < $totalPages): ?>
            <a class="btn-secondary px-4 py-2 text-sm" href="/admin/messages?page=<?= $currentPage + 1 ?>">Plus anciens →</a>
          <?php else: ?><span></span><?php endif; ?>
        </nav>
      <?php endif; ?>
    <?php endif; ?>
  </main>
  <script src="/assets/js/admin-inbox.js?v=<?= file_exists(dirname(__DIR__, 2) . '/public/assets/js/admin-inbox.js') ? filemtime(dirname(__DIR__, 2) . '/public/assets/js/admin-inbox.js') : time() ?>" type="module" defer></script>
  <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
