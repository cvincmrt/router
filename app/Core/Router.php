<?php

namespace App\Core;

class Router {
    private array $routes = [];

    
    public function add(string $path, object $controllerObject, string $method): void {
        $this->routes[$path] = [$controllerObject, $method];
    }

    public function resolve(): void {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
        
        if (isset($this->routes[$path])) {
            [$controller, $method] = $this->routes[$path];
            
            if (method_exists($controller, $method)) {
                $controller->$method();
            } else {
                echo "Chyba: Metóda $method neexistuje v triede " . get_class($controller);
            }
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}