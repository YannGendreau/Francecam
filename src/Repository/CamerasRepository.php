<?php

namespace App\Repository;

use App\Entity\Cameras;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cameras|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cameras|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cameras[]    findAll()
 * @method Cameras[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CamerasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cameras::class);
    }

    // /**
    //  * @return Cameras[] Returns an array of Cameras objects
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
    public function findOneBySomeField($value): ?Cameras
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
