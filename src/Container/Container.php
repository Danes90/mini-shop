<?php

namespace App\Container;

class Container
{
    private array $bindings = [];
    private array $instances = [];

    public function set(string $id, callable $factory): void
    {
        $this->bindings[$id] = $factory;
    }

    public function get(string $id)
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        if (isset($this->bindings[$id])) {
            $this->instances[$id] = $this->bindings[$id]($this);
            return $this->instances[$id];
        }

        throw new \Exception("Service not found: " . $id);
    }
}