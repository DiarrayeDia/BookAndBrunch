<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @return Book[] Returns an array of Book objects
     */

    public function findAllwithAuthors()
    {
        return $this->createQueryBuilder('b')
            ->addSelect('a')
            ->leftJoin('b.authors', 'a')
            ->getQuery()
            ->getResult();
    }

    public function findAllwithCategories(int $nb = 5)
    {
        return $this->createQueryBuilder('b')
            ->addSelect('a')
            ->addSelect('g')
            ->leftJoin('b.areas', 'a')
            ->leftJoin('b.genres', 'g')
            ->setMaxResults($nb)
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Book
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
