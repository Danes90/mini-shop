<?php

use App\Container\Container;
use App\Infrastructure\Database\Connection;
use App\Infrastructure\Session\SessionManager;

$container = new Container();

$container->set(PDO::class, Connection::make());

$container->set(
    SessionManager::class,
    new SessionManager()
);

return $container;