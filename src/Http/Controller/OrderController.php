<?php
namespace App\Http\Controller;

use App\Application\OrderService;

class OrderController
{
    private OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function store(): void
    {
        $this->service->create(100);

        echo "Order created!";
    }
}