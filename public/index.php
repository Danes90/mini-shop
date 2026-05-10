<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../bootstrap/container.php';

$auth = $container->get(\App\Application\AuthService::class);

$auth->register('test@test.com', '123456');

echo "done";