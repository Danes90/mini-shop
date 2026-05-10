<?php 

namespace App\Application;

use App\Domain\Order\OrderRepository;
use App\Infrastructure\Session\SessionManager;

class OrderService
{
    private OrderRepository $repository;
    private SessionManager $session;

    public function __construct(
        OrderRepository $repository,
        SessionManager $session
    ) {
        $this->repository = $repository;
        $this->session = $session;
    }

    /**
     * 
     * order create
     * @param float $price
     * @return void
     */
    public function create(float $price): void
    {
        $this->repository->save([
            'user_id' => $this->session->get('user'),
            'total_price' => $price
        ]);
    }
}