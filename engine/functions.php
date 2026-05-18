<?php

function render($page, $params = []) {

    return renderTemplate(
        LAYOUTS_DIR . 'main',
        [
            'title' => $params['title'],
            'menu' => renderTemplate('menu', $params),
            'content' => renderTemplate($page, $params)
        ]
    );
}

function renderTemplate($page, $params = []) {

    extract($params);

    ob_start();

    include TEMPLATES_DIR . $page . ".php";

    return ob_get_clean();
}

function createThumbnail($sourcePath, $destPath, $width, $height) {

    $info = getimagesize($sourcePath);

    if (!$info) {
        return 'Файл не является изображением';
    }

    switch ($info['mime']) {

        case 'image/jpeg':
            $src = imagecreatefromjpeg($sourcePath);
            break;

        case 'image/png':
            $src = imagecreatefrompng($sourcePath);
            break;

        case 'image/gif':
            $src = imagecreatefromgif($sourcePath);
            break;

        case 'image/webp':
            $src = imagecreatefromwebp($sourcePath);
            break;

        default:
            return 'Неподдерживаемый формат';
    }

    $srcWidth = imagesx($src);
    $srcHeight = imagesy($src);

    $thumb = imagecreatetruecolor($width, $height);

    imagecopyresampled(
        $thumb,
        $src,
        0,
        0,
        0,
        0,
        $width,
        $height,
        $srcWidth,
        $srcHeight
    );

    switch ($info['mime']) {

        case 'image/jpeg':
            imagejpeg($thumb, $destPath);
            break;

        case 'image/png':
            imagepng($thumb, $destPath);
            break;

        case 'image/gif':
            imagegif($thumb, $destPath);
            break;

        case 'image/webp':
            imagewebp($thumb, $destPath);
            break;
    }

    imagedestroy($src);
    imagedestroy($thumb);

    return true;
}

function uploadImage($file) {

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return 'Ошибка загрузки файла';
    }

    $allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp'
    ];

    if (!in_array($file['type'], $allowedTypes)) {
        return 'Недопустимый тип файла';
    }

    $maxSize = 10 * 1024 * 1024;

    if ($file['size'] > $maxSize) {
        return 'Файл слишком большой';
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    $newName = uniqid() . '.' . $ext;

    $bigDir = BASE_PATH . '/images/big/';
    $smallDir = BASE_PATH . '/images/small/';

    if (!is_dir($bigDir)) {
        mkdir($bigDir, 0777, true);
    }

    if (!is_dir($smallDir)) {
        mkdir($smallDir, 0777, true);
    }

    $bigPath = $bigDir . $newName;

    move_uploaded_file($file['tmp_name'], $bigPath);

    $smallPath = $smallDir . $newName;

    createThumbnail(
        $bigPath,
        $smallPath,
        300,
        300
    );

    return 'Изображение успешно загружено';
}