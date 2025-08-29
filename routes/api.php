<?php

use App\Controllers\UrlController;

$router->addRoute('post', '/api/links', function () {
    $links = new UrlController();
    return $links->store();
});

$router->addRoute('get', '/api/links', function () {
    $links = new UrlController();
    return $links->select();
});
