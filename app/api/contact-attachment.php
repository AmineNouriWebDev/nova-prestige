<?php
declare(strict_types=1);

if (!function_exists('json_response')) {
    require_once dirname(__DIR__) . '/bootstrap.php';
}

header('X-Robots-Tag: noindex, nofollow');
header('Cache-Control: private, no-store, max-age=0');
header('X-Content-Type-Options: nosniff');

$storedName = (string)($_GET['file'] ?? '');
if (!preg_match('/^(\d{8})_[a-f0-9]{48}\.(jpg|png|webp|pdf)$/', $storedName, $matches)) {
    http_response_code(404);
    exit;
}

$fileDate = DateTimeImmutable::createFromFormat('!Ymd', $matches[1]);
$oldestAllowedDate = new DateTimeImmutable('today -7 days');
if (!$fileDate || $fileDate > new DateTimeImmutable('today') || $fileDate < $oldestAllowedDate) {
    http_response_code(404);
    exit;
}

$filePath = dirname(__DIR__, 2) . '/storage/contact-attachments/' . $storedName;
if (!is_file($filePath) || !is_readable($filePath)) {
    http_response_code(404);
    exit;
}

$extension = $matches[2];
$contentTypes = [
    'jpg' => 'image/jpeg',
    'png' => 'image/png',
    'webp' => 'image/webp',
    'pdf' => 'application/pdf',
];
$requestedName = basename(str_replace('\\', '/', (string)($_GET['name'] ?? '')));
$downloadName = preg_replace('/[^A-Za-z0-9._ -]/', '_', $requestedName) ?: 'piece-jointe.' . $extension;
$downloadName = substr($downloadName, 0, 120);

header('Content-Type: ' . $contentTypes[$extension]);
header('Content-Length: ' . (string)filesize($filePath));
header('Content-Disposition: attachment; filename="' . addcslashes($downloadName, '"\\') . '"');
readfile($filePath);
exit;
