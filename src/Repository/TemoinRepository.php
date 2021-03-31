<?php

namespace App\Repository;

use App\Entity\Temoin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Temoin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Temoin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Temoin[]    findAll()
 * @method Temoin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemoinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Temoin::class);
    }

    // /**
    //  * @return Temoin[] Returns an array of Temoin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Temoin
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
