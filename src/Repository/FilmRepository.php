<?php

namespace App\Repository;

use App\Entity\Film;
use App\Data\FilmSearchData;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    /**
     * Undocumented variable
     *
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator )
    {
        parent::__construct($registry, Film::class);
        $this->paginator = $paginator;
    }



      /**
    * @return PaginationInterface
    */

    public function findSearch(FilmSearchData $search): PaginationInterface
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
            $query= $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            16

        );
        
    }

}
