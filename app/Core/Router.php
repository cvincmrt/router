<?php

namespace App\Core;

class Router
{
    // zoznam ciest a aka metoda sa ma vykonat
    private array $routes = [];

    /**
     * @param string $path - URL adresa("/login")
     * @param object $controllerObject
     * @param string $method - nazov metody ktora sa spusti
     */

    public function add(string $path, object $controllerObject, string $method) :void
    {
        $this->routes[$path] = [
            "controller" => $controllerObject,
            "method" => $method
        ];
    }
}