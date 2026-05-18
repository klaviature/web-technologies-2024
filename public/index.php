<?php

include __DIR__ . '/../config/config.php';

session_start();

$page = $_GET['page'] ?? 'index';

$params = [];

switch ($page) {

    case 'index':

        $params['title'] = 'Главная';

        break;

    case 'catalog':

        $params['title'] = 'Каталог';

        $params['catalog'] = getCatalog();

        break;

    case 'about':

        $params['title'] = 'О нас';

        $params['phone'] = 444333;

        break;

    case 'bux':

        $params['title'] = 'Бухи';

        $params['message'] = 'Файл загружен';

        $params['files'] = getFiles();

        break;

    case 'galery':

        $params['title'] = 'Галерея';

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_FILES['image'])
        ) {

            $_SESSION['upload_result'] =
                uploadImage($_FILES['image']);

            header('Location: /?page=galery');

            exit;
        }

        if (isset($_SESSION['upload_result'])) {

            $params['upload_result'] =
                $_SESSION['upload_result'];

            unset($_SESSION['upload_result']);
        }

        $dir = BASE_PATH . '/images/small/';

        $params['images'] = array_values(
            array_diff(scandir($dir), ['.', '..'])
        );

        logRequest();

        break;

    default:

        echo '404';

        exit;
}

echo render($page, $params);