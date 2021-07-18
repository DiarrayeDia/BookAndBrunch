<?php

namespace App\Repository;

use App\Entity\Bookshelf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bookshelf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bookshelf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bookshelf[]    findAll()
 * @method Bookshelf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookshelfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bookshelf::class);
    }

    // /**
    //  * @return Bookshelf[] Returns an array of Bookshelf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bookshelf
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
