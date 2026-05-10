<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Order\OrderRepository;
use PDO;

class MySQLOrderRepository implements OrderRepository{

    private PDO $pdo;    

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Summary of save
     * @param array $order
     * @return void
     */
    public function save(array $order): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO orders (user_id, total_price)
             VALUES (:user_id, :total_price)"
        );

        $stmt->execute([
            'user_id' => $order['user_id'],
            'total_price' => $order['total_price']
        ]);
    }
}