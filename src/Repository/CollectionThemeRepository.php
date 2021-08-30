<?php

namespace App\Repository;

use App\Entity\CollectionTheme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollectionTheme|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionTheme|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionTheme[]    findAll()
 * @method CollectionTheme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionTheme::class);
    }

    // /**
    //  * @return CollectionTheme[] Returns an array of CollectionTheme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CollectionTheme
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
