<?php

use App\Core\Route;
use App\Controllers\HomeController;
use App\Controllers\UrlController;
use App\Controllers\QrCodeController;
use App\Controllers\RedirectController;


$router = new Route();

$router->addRoute('get', '/', function () {
    $home = new HomeController();
    return $home->index();
});

$router->addRoute('get', '/links', function () {
    $links = new UrlController();
    return $links->links();
});

$router->addRoute('get', '/qrcodes', function () {
    $qrcodes = new QrCodeController();
    return $qrcodes->qrcodes();
});

$router->addRoute('get', '/BitBond/:code', function ($code) {
    $redirect = new RedirectController();
    return $redirect->handleRedirect($code);
});

require_once "../routes/api.php";


$router->run();
