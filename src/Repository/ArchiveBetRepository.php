<?php

namespace App\Repository;

use App\Entity\ArchiveBet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ArchiveBetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArchiveBet::class);
    }

    public function persist($object){
        return $this->getEntityManager()->persist($object);
    }

    public function flush(){
        return $this->getEntityManager()->flush();
    }
}