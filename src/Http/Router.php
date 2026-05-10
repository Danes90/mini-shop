<?php

namespace App\Http;

class Router
{
    private array $routes = [];

    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function dispatch(string $method, string $path)
    {
        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            http_response_code(404);
            return "Not Found";
        }

        return $handler();
    }
}