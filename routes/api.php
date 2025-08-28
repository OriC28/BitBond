<?php

use App\Controllers\UrlController;
use App\Core\Route;


$router = new Route();

$router->addRoute('post', '/api/links', function ($request) {
    $links = new UrlController();
    return $links->store($request);
});

$router->run();
