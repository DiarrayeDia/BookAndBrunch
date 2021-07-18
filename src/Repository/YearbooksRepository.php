<?php

namespace App\Repository;

use App\Entity\Yearbooks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Yearbooks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yearbooks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yearbooks[]    findAll()
 * @method Yearbooks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YearbooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yearbooks::class);
    }

    // /**
    //  * @return Yearbooks[] Returns an array of Yearbooks objects
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
    public function findOneBySomeField($value): ?Yearbooks
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
