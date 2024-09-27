<?php

namespace App\Domain\Order;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "products")]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $name;

    #[ORM\Column(type: "float")]
    private float $price;

    #[ORM\ManyToOne(targetEntity: "Order", inversedBy: "products")]
    #[ORM\JoinColumn(nullable: false)]
    private Order $order;

    public function __construct(string $name, float $price, Order $order)
    {
        $this->name = $name;
        $this->price = $price;
        $this->order = $order;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
