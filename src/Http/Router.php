<?php

namespace App\Http;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][] = [
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][] = [
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch(string $method, string $uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes[$method] ?? [] as $route) {

            $pattern = $this->convertPathToRegex($route['path']);

            if (preg_match($pattern, $uri, $matches)) {

                array_shift($matches); // első full match eltávolítása

                return call_user_func_array($route['handler'], $matches);
            }
        }

        http_response_code(404);
        return "Not Found";
    }

    private function convertPathToRegex(string $path): string
    {
        $pattern = preg_replace('#\{(\w+)\}#', '([^/]+)', $path);

        return "#^" . $pattern . "$#";
    }
}