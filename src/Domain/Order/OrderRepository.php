<?php

namespace App\Domain\Order;

interface OrderRepository{
     public function save(array $order): void;
}