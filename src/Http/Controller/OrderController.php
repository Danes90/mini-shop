<?php

namespace App\Http\Controller;

use App\Http\Request;
use App\Application\OrderService;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct()
    {
        // most még kézzel, később container fogja
        $this->orderService = new OrderService(
            new \App\Infrastructure\Persistence\MySQLOrderRepository(
                new \PDO('mysql:host=localhost;dbname=test', 'root', '')
            ),
            new \App\Infrastructure\Session\SessionManager()
        );
    }

    public function store(Request $request)
    {
        $data = $request->body();

        $this->orderService->create($data['price']);

        return $this->json([
            'status' => 'success',
            'message' => 'order created'
        ]);
    }
}