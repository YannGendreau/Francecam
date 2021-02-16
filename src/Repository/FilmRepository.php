<?php

namespace App\Repository;

use App\Entity\Film;
use App\Data\FilmSearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }



      /**
    * @return Film[]
    */

    public function findSearch(FilmSearchData $search): array
    {
        $query = $this
                    ->createQueryBuilder('f')
                    ->select('f','m')
                    // ->select('f', 'g', 'm')
                    ->leftJoin('f.genres', 'g')
                    ->leftJoin('f.marques', 'm')
                   
                    ;
                    
        if (!empty($search->q)) {
            $query = $query
                    ->andWhere('f.title LIKE :q')
                    // ->orWhere('f.annee LIKE :q')
                    ->setParameter('q', "%{$search->q}%")
                    ;
        }

        if (!empty($search->genres)) {
            $query = $query
                ->andWhere('g.id IN (:genres)')
                ->setParameter('genres', $search->genres)
                ;
        }
        if (!empty($search->annee)) {
             $query = $query
            ->andWhere('f.annee IN (:annee)')
            ->setParameter('annee', $search->annee)
            ;
            }
        if (!empty($search->decade)) {
            $query = $query
            ->andWhere('f.decade IN (:decade)')
            ->setParameter('decade', $search->decade)
            ;
            }
        if (!empty($search->marques)) {
            $query = $query
            ->andWhere('m.id IN (:marques)')
            ->setParameter('marques', $search->marques)
            ;
        }
            return $query->getQuery()->getResult();
        
    }

    // /**
    //  * @return Film[] Returns an array of Film objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Film
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
