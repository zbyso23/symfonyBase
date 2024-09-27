<?php

namespace App\Service;

use App\Domain\Order\Order;
use App\Repository\OrderRepository;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function addProductToOrder(Order $order, $product): void
    {
        $order->addProduct($product);
    }

    public function calculateOrderTotal(Order $order): float
    {
        return $order->calculateTotalPrice();
    }

    public function getAllOrders(): array
    {
        return $this->orderRepository->findAllOrders();
    }
}
