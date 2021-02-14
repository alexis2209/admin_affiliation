<?php

namespace App\Repository;

use App\Entity\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPost[]    findAll()
 * @method BlogPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, BlogPost::class);
        $this->entityManager = $entityManager;
    }

    public function changeValidite(BlogPost $blogPost){
        if ($blogPost->getValid())
            $blogPost->setValid(false);
        else
            $blogPost->setValid(true);
        $this->entityManager->persist($blogPost);
        $this->entityManager->flush();
        return $blogPost;
    }

    public function delete(BlogPost $blogPost){
        $blogPost->setDeleted(true);
        $this->entityManager->persist($blogPost);
        $this->entityManager->flush();
        return $blogPost;
    }

    /**
    * @return BlogPost[] Returns an array of BlogPost objects
    */
    public function getBlogList($filters = [])
    {
        $select = $this->createQueryBuilder('b')
            ->select(['b.id', 'b.titre AS title', 'b.blogImage as image', 'b.createdAt as date', 'b.slug', 'b.content', 'c.content', 'c.slug AS slugCateg', 'c.libelle AS libCateg'])
            ->join('b.categories', 'c')
            //->andWhere('b.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10);

        if (!empty($filters)){
            $i = 0;
            foreach ($filters as $key => $filter){
                $select->andWhere('b.'.$key.' = :param'.$i)
                    ->setParameter('param'.$i, $filter);
                $i++;
            }
        }

        $res = $select->getQuery()
            ->getResult();

        $i = 0;
        foreach ($res as $temp){
            $res[$i]['categories'] = [$res[$i]['libCateg']];
            $res[$i]['date'] = $res[$i]['date']->format('Y-m-d');
            $res[$i]['slug'] = "blog/" . $res[$i]['slugCateg'] . '/' . $res[$i]['slug'];
            $res[$i]['slugCateg'] = "blog/" . $res[$i]['slugCateg'];
            $i++;
        }
        return $res;
    }


    /**
     * @return BlogPost[] Returns an array of BlogPost objects
     */
    public function getBlogPost()
    {
        $select = $this->createQueryBuilder('b')
            ->select(['b.id', 'b.titre AS title', 'b.blogImage as image', 'b.createdAt as date', 'b.slug', 'b.content', 'c.content', 'c.slug AS slugCateg', 'c.libelle AS libCateg'])
            ->join('b.categories', 'c')
            //->andWhere('b.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10);

        $res = $select->getQuery()
            ->getResult();

        $i = 0;
        foreach ($res as $temp){
            $res[$i]['categories'] = [$res[$i]['libCateg']];
            $res[$i]['date'] = $res[$i]['date']->format('Y-m-d');
            $res[$i]['slug'] = "blog/" . $res[$i]['slugCateg'] . '/' . $res[$i]['slug'];
            $res[$i]['slugCateg'] = "blog/" . $res[$i]['slugCateg'];
            $i++;
        }
        return $res;
    }


    /*
    public function findOneBySomeField($value): ?BlogPost
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
