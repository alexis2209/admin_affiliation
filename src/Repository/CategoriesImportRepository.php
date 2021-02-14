<?php

namespace App\Repository;

use App\Entity\CategoriesImport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesImportRepository extends ServiceEntityRepository
{



    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, CategoriesImport::class);
        $this->entityManager = $entityManager;
    }

    public function persist($object){
        return $this->getEntityManager()->persist($object);
    }

    public function flush(){
        return $this->getEntityManager()->flush();
    }



}
