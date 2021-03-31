<?php

namespace App\Repository;

use App\Entity\CentreComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CentreComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CentreComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CentreComment[]    findAll()
 * @method CentreComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CentreCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CentreComment::class);
    }

    // /**
    //  * @return CentreComment[] Returns an array of CentreComment objects
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
    public function findOneBySomeField($value): ?CentreComment
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
