<?php

namespace App\Http;

class Router
{
    private array $routes = [];

    /**
     * post route
     * @param string $path
     * @param callable $handler
     * @return void
     */
    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    /**
     * get route
     * @param string $path
     * @param callable $handler
     * @return void
     */
    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    /**
     * dispatch
     * @param string $method
     * @param string $path
     */
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