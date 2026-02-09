<?php

namespace App\Core;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    // Déclarer une route GET
    public function get(string $path, $action)
    {
        $this->routes['GET'][$path] = $action;
    }

    // Déclarer une route POST
    public function post(string $path, $action)
    {
        $this->routes['POST'][$path] = $action;
    }

    // Lancer le bon controller ou callable
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Enlever le préfixe
        $uri = str_replace('/crashProject/public', '', $uri);
        if ($uri === '') $uri = '/';

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404 - Page introuvable";
            return;
        }

        $action = $this->routes[$method][$uri];

        // Si c'est un callable (fonction ou [objet, méthode])
        if (is_callable($action)) {
            call_user_func($action);
            return;
        }

        // Sinon, traiter la string 'Controller@method'
        [$controllerName, $methodName] = explode('@', $action);
        $controllerClass = "App\\Controllers\\" . $controllerName;

        $controller = new $controllerClass(); // Pour les contrôleurs sans dépendances
        $controller->$methodName();
    }
}
