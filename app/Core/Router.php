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

    public function resolve() :void
    {
        // ziskame adresu z prehliadaca napr: /router/public/kontakt
        $requestUri = $_SERVER["REQUEST_URI"];

        // musime ocistit adresu keby tam bol query string napr: router/public/kontakt?name=120. To co je od ? je nepotrebne
        $path = parse_url($requestUri,PHP_URL_PATH);

        if(isset($this->routes["path"])){

            $route = $this->routes["path"];
            $controller = $route["controller"];
            $method = $route["method"];

            // je to iste ako $authoController->login();
            $controller->$method();
        }else{
            http_response_code(404);
            echo "404 - Stranka, ktoru hladate, neexistuje!!!";
        }
    }
}