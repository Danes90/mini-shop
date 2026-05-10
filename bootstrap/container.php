<?php

use App\Container\Container;
use App\Infrastructure\Database\Connection;
use App\Infrastructure\Session\SessionManager;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\MySQLUserRepository;
use App\Application\AuthService;

$container = new Container();

// PDO
$container->set(PDO::class, function () {
    return Connection::make();
});

// Session
$container->set(SessionManager::class, function () {
    return new SessionManager();
});

// Repository
$container->set(UserRepository::class, function ($c) {
    return new MySQLUserRepository(
        $c->get(PDO::class)
    );
});

// AuthService
$container->set(AuthService::class,function ($c) {
    return new AuthService(
        $c->get(UserRepository::class),
        $c->get(SessionManager::class)
    );
});

return $container;
