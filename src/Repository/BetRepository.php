<?php

namespace App\Repository;

use App\Entity\Bet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bet::class);
    }

    public function getOldEvent(){
        $select = $this->createQueryBuilder('b')
            ->select('b')
            ->join('App\Entity\Fixture', 'f', 'WITH', 'b.fixtureId = f.fixtureId')
            ->where('f.startDate < :date')
            ->setParameter('date', new \DateTime())
            ->setMaxResults(10000);

        $res = $select->getQuery()
            ->getResult();
        return $res;
    }

    public function persist($object){
        return $this->getEntityManager()->persist($object);
    }

    public function flush(){
        return $this->getEntityManager()->flush();
    }

    public function remove($object){
        return $this->getEntityManager()->remove($object);
    }
}