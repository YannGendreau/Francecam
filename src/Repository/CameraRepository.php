<?php

namespace App\Repository;

use App\Entity\Camera;
use App\Data\SearchHomeData;
use App\Data\CameraSearchData;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Camera|null find($id, $lockMode = null, $lockVersion = null)
 * @method Camera|null findOneBy(array $criteria, array $orderBy = null)
 * @method Camera[]    findAll()
 * @method Camera[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CameraRepository extends ServiceEntityRepository
{
   

             /**
     * Undocumented variable
     *
     * @var PaginatorInterface
     */
    private $paginator;


    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Camera::class);
        $this->paginator = $paginator;
    }

      //Modele classé par date

      public function modeleByDateDesc()
      {
          return $this->createQueryBuilder('m')
            ->select('m', 'c' )
            ->leftJoin('m.modele', 'c' )
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
      }

        /**
    * @return PaginationInterface
    */

    public function findSearch(CameraSearchData $search): PaginationInterface
    {


        $query = $this
            ->createQueryBuilder('c')
            ->select('c', 'm', 'f', 'p')
            ->leftJoin('c.marque', 'm')    
            ->leftJoin('c.modele', 'f')    
            ->leftJoin('f.format', 'p')
            ->orderBy('c.name', 'asc')  
        ;
        
        if (!empty($search->q)) {
        $query = $query
            ->andWhere('m.name LIKE :q')
            ->orWhere('c.name LIKE :q')
            ->orWhere('f.name LIKE :q')
            ->setParameter('q', "%{$search->q}%")
        ;
        }

        if (!empty($search->format)) {
        $query = $query
            ->andWhere('p.id IN (:format)')
            ->setParameter('format', $search->format)
        ;
        }

        if (!empty($search->marque)) {
        $query = $query
            ->andWhere('m.id IN (:marques)')
            ->setParameter('marques', $search->marque)
        ;
        }
        if (!empty($search->modele)) {
        $query = $query
            ->andWhere('f.id IN (:modeles)')
            ->setParameter('modeles', $search->modele)
        ;
        }
      

        if (!empty($search->decade)) {
        $query = $query
            ->andWhere('f.decade IN (:decade)')
            ->setParameter('decade', $search->decade)
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
     * Barre de recherche; Query sur les champs Modele
     *
     * @param SearchHomeData $search
     * @return PaginationInterface
     */
    public function findHomeSearch(SearchHomeData $search): PaginationInterface
    {
        $query = $this
                ->createQueryBuilder('c')
                ->select('c')                
                ;

        if (!empty($search->r)) {
            $query = $query
                ->andWhere('c.name LIKE :r')
                ->setParameter('r', "%{$search->r}%")
                ;
        }       
       
            $query= $query->getQuery();
            
        return $this->paginator->paginate(
            $query,
            $search->page,
            3

        )
        ;      
    }


}
