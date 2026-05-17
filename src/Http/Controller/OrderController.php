<?php

namespace App\Http\Controller;

use App\Application\OrderService;
use App\Http\Request;
use App\Http\Controller;

class OrderController extends Controller
{
    private OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $data = $request->body();

        $this->service->create($data['price']);

        return $this->json([
            'status' => 'success',
            'message' => 'order created'
        ]);
    }
}