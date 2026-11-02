<?php

if (PHP_VERSION_ID < 70000) {
    error_reporting(E_ALL & ~E_COMPILE_WARNING);
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        require __DIR__ . '/index.php';
        break;

    case 'exercise1':
        require __DIR__ . '/SSP05_1/SSP05_1.php';
        break;

    case 'exercise2':
        require __DIR__ . '/SSP05_2/SSP05_2.php';
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        echo 'Page not found.';
        break;
}