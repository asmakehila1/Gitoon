<?php

namespace App\Repository;

use App\Entity\OrgEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrgEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrgEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrgEvent[]    findAll()
 * @method OrgEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrgEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrgEvent::class);
    }

    // /**
    //  * @return OrgEvent[] Returns an array of OrgEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrgEvent
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
