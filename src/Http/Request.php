<?php

namespace App\Http;

class Request
{
    private array $body;
    private array $query;
    private array $params;
    private string $method;
    private string $uri;

    public function __construct(array $params = [])
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '/';

        $this->query = $_GET ?? [];

        $input = file_get_contents('php://input');
        $this->body = json_decode($input, true) ?? [];

        $this->params = $params;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function body(): array
    {
        return $this->body;
    }

    public function query(?string $key = null)
    {
        return $key ? ($this->query[$key] ?? null) : $this->query;
    }

    public function param(string $key)
    {
        return $this->params[$key] ?? null;
    }
}