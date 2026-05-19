<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Vercel filesystem itu Read-Only. Kita buat & alihkan folder storage ke /tmp
$storagePath = '/tmp/storage';
foreach (['/framework/views', '/framework/cache', '/framework/sessions', '/logs'] as $dir) {
    if (!is_dir($storagePath . $dir)) {
        mkdir($storagePath . $dir, 0755, true);
    }
}

// 2. Muat Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 3. Boot Laravel & paksa pakai storage baru di /tmp tadi
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->useStoragePath($storagePath);

// 4. Jalankan aplikasi untuk menangani request browser
$app->handleRequest(Request::capture());