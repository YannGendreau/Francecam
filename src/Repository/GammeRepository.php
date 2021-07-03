<?php

namespace App\Repository;

use App\Entity\Gamme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gamme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gamme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gamme[]    findAll()
 * @method Gamme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gamme::class);
    }


}
