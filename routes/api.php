<?php

use App\Controllers\UrlController;
use App\Controllers\QrCodeController;

$router->addRoute('post', '/api/links', function () {
    $links = new UrlController();
    return $links->store();
});

$router->addRoute('get', '/api/links', function () {
    $links = new UrlController();
    return $links->select();
});

$router->addRoute('post', '/api/qrcodes', function () {
    $qrcodes = new QrCodeController();
    return $qrcodes->store();
});

$router->addRoute('get', '/api/qrcodes', function () {
    $qrcodes = new QrCodeController();
    return $qrcodes->select();
});
