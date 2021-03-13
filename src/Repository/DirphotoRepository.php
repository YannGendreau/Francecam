<?php

namespace App\Repository;

use App\Entity\Dirphoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dirphoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dirphoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dirphoto[]    findAll()
 * @method Dirphoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DirphotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dirphoto::class);
    }

    // /**
    //  * @return Dirphoto[] Returns an array of Dirphoto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dirphoto
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
