<?php

namespace App\Repository;

use App\Domain\Order\Order;  // Odkazujeme na správný namespace
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function save(Order $order): void
    {
        $this->getEntityManager()->persist($order);
        $this->getEntityManager()->flush();
    }

    public function findAllOrders(): array
    {
        return $this->findAll();
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?Order
    {
        return parent::find($id, $lockMode, $lockVersion);
    }
}
