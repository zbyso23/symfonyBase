<?php

namespace App\Domain\Order;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: App\Repository\OrderRepository::class)]
#[ORM\Table(name: "orders")]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\OneToMany(targetEntity: "Product", mappedBy: "order", cascade: ["persist"])]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function calculateTotalPrice(): float
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice();
        }
        return $total;
    }
}