<?php

namespace App\Core;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    // Declarer une route GET
    public function get(string $path, string $action)
    {
        $this->routes['GET'][$path] = $action;
    }

    // Declare une route POST
    public function post(string $path, string $action)
    {
        $this->routes['POST'][$path] = $action;
    }

    // Lancer le bon controller
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Enlever /crashProject/public
        $uri = str_replace('/crashProject/public', '', $uri);
        if ($uri === '') $uri = '/';
        
        if(!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404 - Page introuvable";
            return;
        }

        // Separe en 2 parties
        [$controllerName, $methodName] = explode('@', $this->routes[$method][$uri]);

        $controllerClass = "App\\Controllers\\" . $controllerName; // App\Controllers\HomeController

        $controller = new $controllerClass();
        $controller->$methodName(); // Appelle la méthode correspondante de la classe
    }
}