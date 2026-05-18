<?php

define('TEMPLATES_DIR', __DIR__ . '/templates/');
define('LAYOUTS_DIR', __DIR__ . '/layouts/');

$page = isset($_GET['page']) ? $_GET['page'] : 'index';

$params = [];

switch ($page) {

    case 'index':
        $params['title'] = 'Главная';
        $params['test'] = 'ПРОВЕРКА';
        break;

    case 'catalog':
        $params['title'] = 'Каталог';
        $params['catalog'] = getCatalog();
        break;

    case 'about':
        $params['title'] = 'О нас';
        $params['phone'] = '+7 495 12-23-12';
        break;

    case 'apicatalog':
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
        exit;

    default:
        http_response_code(404);
        echo "404 страница не найдена";
        exit;
}

function getCatalog() {
    return [
        ['name' => 'Яблоко', 'price' => 24, 'image' => 'apple.png'],
        ['name' => 'Банан', 'price' => 1, 'image' => 'banana.png'],
        ['name' => 'Апельсин', 'price' => 12, 'image' => 'orange.png'],
    ];
}

function getMenu() {
    return [
        [
            'title' => 'Главная',
            'link' => 'index.php'
        ],
        [
            'title' => 'Каталог',
            'link' => 'index.php?page=catalog',
            'children' => [
                ['title' => 'Фрукты', 'link' => 'index.php?page=catalog&category=fruits'],
                ['title' => 'Овощи', 'link' => 'index.php?page=catalog&category=vegetables'],
            ]
        ],
        [
            'title' => 'О нас',
            'link' => 'index.php?page=about'
        ],
    ];
}

function render($page, $params = []) {

    return renderTemplate('layouts/main', [
        $title = isset($params['title']) ? $params['title'] : '',
        'menu' => renderTemplate('menu', ['menus' => getMenu()]),
        'content' => renderTemplate($page, $params)
    ]);
}

function renderTemplate($page, $params = []) {
    $file = TEMPLATES_DIR . $page . ".php";

    if (!file_exists($file)) {
        return "Template not found: $page";
    }

    extract($params);
    ob_start();
    include $file;
    return ob_get_clean();
}

echo render($page, $params);