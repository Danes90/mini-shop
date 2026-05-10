<?php

set_exception_handler(function (Throwable $e) {

    http_response_code(500);

    header('Content-Type: application/json');

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
});

session_start();
require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../bootstrap/container.php';

use App\Http\Router;
$router = new Router();

/**
 * =========================
 * REGISTER
 * =========================
 */
$router->post('/register', function () use ($container) {
    $auth = $container->get(\App\Application\AuthService::class);
    $auth->register('test@test.com', '123456');

    return "registered";
});

/**
 * =========================
 * LOGIN
 * =========================
 */
$router->post('/login', function () use ($container) {

    $auth = $container->get(\App\Application\AuthService::class);
    $result = $auth->login('test@test.com', '123456');

    return $result ? "logged in" : "login failed";
});

/**
 * =========================
 * ORDER (protected route)
 * =========================
 */
$router->post('/order', function () use ($container) {

    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        return "Unauthorized";
    }

    $orderService = $container->get(\App\Application\OrderService::class);
    $orderService->create(100);

    return "order created";
});

/**
 * =========================
 * DISPATCH REQUEST
 * =========================
 */
echo $router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);