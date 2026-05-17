<?php

namespace App\Container;

use ReflectionClass;
use ReflectionParameter;

class Container
{
    private array $instances = [];

    public function set(string $id, $instance): void
    {
        $this->instances[$id] = $instance;
    }

    public function get(string $class)
    {
        // ha már létezik
        if (isset($this->instances[$class])) {
            return $this->instances[$class];
        }

        $reflection = new ReflectionClass($class);

        $constructor = $reflection->getConstructor();

        // nincs constructor
        if (!$constructor) {
            return new $class();
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $parameter) {

            $dependencies[] = $this->resolveDependency($parameter);
        }

        $instance = $reflection->newInstanceArgs($dependencies);

        $this->instances[$class] = $instance;

        return $instance;
    }

    private function resolveDependency(ReflectionParameter $parameter)
    {
        $type = $parameter->getType();

        if (!$type) {
            throw new \Exception('Missing type hint');
        }

        return $this->get($type->getName());
    }
}