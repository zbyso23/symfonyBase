<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\OrderService;
use App\Repository\OrderRepository;
use App\Domain\Order\Product;
use App\Domain\Order\Order;
use Faker\Factory;

class OrderController extends AbstractController
{
    private OrderService $orderService;
    private OrderRepository $orderRepository;

    public function __construct(OrderService $orderService, OrderRepository $orderRepository)
    {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(): Response
    {
        $faker = Factory::create();

        // Vytvoříme objednávku
        $order = new Order();

        // Přidáme několik falešných produktů
        for ($i = 0; $i < 5; $i++) {
            $productName = $faker->word;
            $productPrice = $faker->randomFloat(2, 10, 500);
            $product = new Product($productName, $productPrice, $order);
            $this->orderService->addProductToOrder($order, $product);
        }

        // Uložíme objednávku do databáze
        $this->orderRepository->save($order);

        $totalPrice = $this->orderService->calculateOrderTotal($order);

        return new Response("Total price: " . $totalPrice);
    }

    public function listOrders(): Response
    {
        $orders = $this->orderService->getAllOrders();

        $output = '<html><body>';
        foreach ($orders as $order) {
            $output .= '<h3>Order ID: ' . $order->getId() . '</h3>';
            $output .= '<ul>';
            foreach ($order->getProducts() as $product) {
                $output .= '<li>' . $product->getName() . ' - $' . $product->getPrice() . '</li>';
            }
            $output .= '</ul>';
            $output .= '<strong>Total: $' . $order->calculateTotalPrice() . '</strong><hr>';
        }
        $output .= '</body></html>';

        return new Response($output);
    }
}
