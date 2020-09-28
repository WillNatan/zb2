<?php

namespace App\Repository;

use App\Entity\ShopReviews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShopReviews|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShopReviews|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShopReviews[]    findAll()
 * @method ShopReviews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopReviewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopReviews::class);
    }

    // /**
    //  * @return ShopReviews[] Returns an array of ShopReviews objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShopReviews
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
