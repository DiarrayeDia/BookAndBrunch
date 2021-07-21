<?php

namespace App\Repository;

use App\Entity\Yearbook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Yearbook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yearbook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yearbook[]    findAll()
 * @method Yearbook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YearbookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yearbook::class);
    }

    // /**
    //  * @return Yearbook[] Returns an array of Yearbook objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Yearbook
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
