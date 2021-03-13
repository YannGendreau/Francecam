<?php

namespace App\Repository;

use App\Entity\Mount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mount|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mount|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mount[]    findAll()
 * @method Mount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mount::class);
    }

    // /**
    //  * @return Mount[] Returns an array of Mount objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mount
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
