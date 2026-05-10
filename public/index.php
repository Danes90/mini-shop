<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Application\OrderService;
use App\Http\Controller\OrderController;
use App\Http\Middleware\AuthMiddleware;
use App\Infrastructure\Database\Connection;
use App\Infrastructure\Persistence\MySQLOrderRepository;

$_SESSION['user'] = 2;

$pdo = Connection::make();

$orderRepository = new MySQLOrderRepository($pdo);

$orderService = new OrderService($orderRepository);

$orderController = new OrderController($orderService);

$middleware = new AuthMiddleware();

$middleware->handle(function () use ($orderController) {

    $orderController->store();

});