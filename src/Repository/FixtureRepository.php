<?php

namespace App\Repository;

use App\Entity\Fixture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FixtureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fixture::class);
    }

    public function persist($object){
        return $this->getEntityManager()->persist($object);
    }

    public function flush(){
        return $this->getEntityManager()->flush();
    }
}