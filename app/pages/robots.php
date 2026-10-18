<?php
declare(strict_types=1);

/**
 * Dynamic robots.txt
 */

header('Content-Type: text/plain; charset=UTF-8');

$baseUrl = rtrim($_ENV['APP_URL'] ?? '', '/');
if ($baseUrl === '') {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443) ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $baseUrl = "{$scheme}://{$host}";
}

echo "User-agent: *\n";
echo "Allow: /\n\n";
echo "Sitemap: {$baseUrl}/sitemap.xml\n";
