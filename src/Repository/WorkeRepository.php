<?php

namespace App\Repository;

use App\Entity\Worke;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Worke|null find($id, $lockMode = null, $lockVersion = null)
 * @method Worke|null findOneBy(array $criteria, array $orderBy = null)
 * @method Worke[]    findAll()
 * @method Worke[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Worke::class);
    }

    // /**
    //  * @return Worke[] Returns an array of Worke objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Worke
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
