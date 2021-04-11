<?php

namespace App\Repository;

use App\Entity\Film;
use App\Data\FilmSearchData;
use App\Data\SearchHomeData;
use App\Data\CameraSearchData;
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

     //Film classé par date descendante

     public function filmByDateDesc()
     {
        return $this->createQueryBuilder('m')
        ->orderBy('m.createdAt', 'DESC')
        ->setMaxResults(5)
        ->getQuery()
        ->getResult()
      ;
     }


      /**
    * @return PaginationInterface
    */

    public function findSearch(FilmSearchData $search): PaginationInterface
    {
        $query = $this
                    ->createQueryBuilder('f')
                    ->select('f','m')
                    ->leftJoin('f.genres', 'g')
                    ->leftJoin('f.marques', 'm')
                   
                    ;
                    
        if (!empty($search->q)) {
            $query = $query
                    ->andWhere('f.title LIKE :q')
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
            20

        );      
    }
    
     /**
     * Recherche des films en cameras en fonction du formulaire (FULLTEXT)
     * Non retenu (voir function suivante)
     * @return void 
     */
    public function search($mots = null){
        $query = $this->createQueryBuilder('f');
    
        if($mots != null){
            $query->andWhere('MATCH_AGAINST(f.title) AGAINST (:mots boolean)> 0')
                ->setParameter('mots', $mots);
        }
        // if($categorie != null){
        //     $query->leftJoin('a.categories', 'c');
        //     $query->andWhere('c.id = :id')
        //         ->setParameter('id', $categorie);
        // }
        return $query->getQuery()->getResult();
    }

  
    /**
     * Barre de recherche; Query sur les champs Film
     *
     * @param SearchHomeData $search
     * @return PaginationInterface
     */
    public function findHomeSearch(SearchHomeData $search): PaginationInterface
    {
        $query = $this
                    ->createQueryBuilder('f')
                    ->select('f','m', 'g')
                    ->leftJoin('f.marques', 'm')
                    ->leftJoin('f.modeles', 'g')
                   
                    ;

        if (!empty($search->r)) {
            $query = $query
                    ->andWhere('f.title LIKE :r')
                    ->orWhere('m.name LIKE :r')
                    ->orWhere('g.name LIKE :r')
                    ->setParameter('r', "%{$search->r}%")
                    ;
        }       
       
            $query= $query->getQuery();

        return $this->paginator->paginate(
            $query,
            $search->page,
            20

        );      
    }

      
}
