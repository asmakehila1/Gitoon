<?php

namespace App\Repository;

use App\Entity\Promotion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Promotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promotion[]    findAll()
 * @method Promotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promotion::class);
    }


    public function countPromotionByTypes()
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.id) as nombre','p.type_promo as type')
            ->groupBy('p.type_promo')
            ->getQuery()
            ->getResult() ;

    }

public function orderByPriceNew(){
        return $this->createQueryBuilder('p')
          //  ->select('*')
            ->orderBy('p.prix_nv', 'DESC')
            ->getQuery()
            ->getResult() ;
}
    public function orderByPriceOld(){
        return $this->createQueryBuilder('p')
           // ->select('*')
            ->orderBy('p.prix_ancien', 'DESC')
            ->getQuery()
            ->getResult() ;
    }
    // /**
    //  * @return Promotion[] Returns an array of Promotion objects
    //  */
    /*

    */

    /*
    public function findOneBySomeField($value): ?Promotion
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
