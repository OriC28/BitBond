<?php

namespace App\Core;

class Route
{
    private array $routes = array();

    public function addRoute(string $method, string $url, callable $handle): void
    {
        $this->routes[strtoupper($method)][$url] = $handle;
    }

    public function run(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (strpos($requestUri, '?')) {
            $requestUri = substr($requestUri, 0, strpos($requestUri, '?'));
        }

        foreach ($this->routes[$requestMethod] as $route => $handler) {
            if (strpos($route, ':') !== false) {
                $route = preg_replace('/:([a-zA-Z0-9]+)/', '([a-zA-Z0-9]+)', $route);
            }

            if (preg_match("#^$route$#", $requestUri, $matches)) {
                $params = array_slice($matches, 1);
                echo $handler(...$params);
                return;
            }
        }

        http_response_code(404);
        echo "Ruta no encontrada";
    }
}
