<?php

namespace App\Repository;

use App\Entity\Worker;
use App\Entity\WorkingTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkingTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkingTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkingTime[]    findAll()
 * @method WorkingTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkingTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkingTime::class);
    }

    public function findAllOrderBy($order)
    {
        $q = $this->createQueryBuilder('q');
        $q->join(Worker::class,'worker',Join::WITH,'q.worker_id = worker.id');

        if(!empty($order)) {
            if($order == 'name'){
                $q->orderBy('worker.name');
            }else{
                $q->orderBy('q.date');
            }

            return $q->getQuery()->getResult();


        }else{
            return $this->findAll();
        }
    }

    // /**
    //  * @return WorkingTime[] Returns an array of WorkingTime objects
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
    public function findOneBySomeField($value): ?WorkingTime
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
