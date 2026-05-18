<?php

include __DIR__ . '/../config/config.php';

if (!isset($_GET['file'])) {
    exit('Файл не указан');
}

$file = basename($_GET['file']);

$type = $_GET['type'] ?? 'small';

$path = BASE_PATH . "/images/$type/" . $file;

if (!file_exists($path)) {
    exit('Файл не найден');
}

$info = getimagesize($path);

header('Content-Type: ' . $info['mime']);

readfile($path);