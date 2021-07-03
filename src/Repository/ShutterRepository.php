<?php

namespace App\Repository;

use App\Entity\Shutter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Shutter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shutter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shutter[]    findAll()
 * @method Shutter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShutterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shutter::class);
    }

  
}
