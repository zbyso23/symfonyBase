<?php

namespace App\Tests\Service;

use App\Domain\Order\Order;
use App\Domain\Order\Product;
use App\Service\OrderService;
use App\Repository\OrderRepository;
use PHPUnit\Framework\TestCase;

class OrderServiceTest extends TestCase
{
    private $orderRepository;
    private $orderService;

    protected function setUp(): void
    {
        // Mockujeme OrderRepository
        $this->orderRepository = $this->createMock(OrderRepository::class);
        // Předáváme mockovaný OrderRepository do OrderService
        $this->orderService = new OrderService($this->orderRepository);
    }

    public function testAddProductToOrder(): void
    {
        $order = new Order();
        $product = new Product('Test Product', 100.0, $order);

        $this->orderService->addProductToOrder($order, $product);

        $this->assertCount(1, $order->getProducts());
        $this->assertSame($product, $order->getProducts()[0]);
    }

    public function testCalculateOrderTotal(): void
    {
        $order = new Order();
        $product1 = new Product('Test Product 1', 100.0, $order);
        $product2 = new Product('Test Product 2', 200.0, $order);

        $this->orderService->addProductToOrder($order, $product1);
        $this->orderService->addProductToOrder($order, $product2);

        $total = $this->orderService->calculateOrderTotal($order);

        $this->assertEquals(300.0, $total);
    }
}
