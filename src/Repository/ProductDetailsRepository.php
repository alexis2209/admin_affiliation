<?php

namespace App\Repository;

use App\Entity\ProductDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDetails::class);
    }

    public function persist($object){
        return $this->getEntityManager()->persist($object);
    }
}