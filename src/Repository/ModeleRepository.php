<?php

namespace App\Repository;

use App\Entity\Modele;
use App\Data\SearchHomeData;
use App\Data\CameraSearchData;
use Knp\Component\Pager\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Modele|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modele|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modele[]    findAll()
 * @method Modele[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeleRepository extends ServiceEntityRepository
{

   

          /**
     * Undocumented variable
     *
     * @var PaginatorInterface
     */
    private $paginator;


    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Modele::class);
        $this->paginator = $paginator;
    }



     //Modele classé par date

    public function modeleByDateDesc()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.createdAt', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }
     
     //Modele classé par nom

     public function modeleByIdAsc()
     {
        return $this->createQueryBuilder('m')
            ->orderBy('m.name', 'ASC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
    ;
     }

      /**
     * Recherche des films en cameras en fonction du formulaire
     * @return void 
     */
    public function search($mots = null){
        $query = $this->createQueryBuilder('c');
    
        if($mots != null){
            $query->andWhere('MATCH_AGAINST(c.name) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);

        }

        return $query->getQuery()->getResult();
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
                ->createQueryBuilder('g')
                ->select('g','m', 'f')
                ->leftJoin('g.marque', 'm')
                ->leftJoin('g.films', 'f')
                
                ;

        if (!empty($search->r)) {
            $query = $query
                ->andWhere('g.name LIKE :r')
                ->orWhere('f.title LIKE :r')
                ->orWhere('m.name LIKE :r')
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

      /**
    * @return PaginationInterface
    */

    public function findSearch(CameraSearchData $search): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('c')
            ->select('c', 'm', 'f')
            ->leftJoin('c.marque', 'm')    
            ->leftJoin('c.format', 'f')    
        ;
        
        if (!empty($search->q)) {
        $query = $query
            ->andWhere('m.name LIKE :q')
            ->orWhere('c.name LIKE :q')
            ->orWhere('c.sortie LIKE :q')
            ->setParameter('q', "%{$search->q}%")
        ;
        }

        if (!empty($search->format)) {
        $query = $query
            ->andWhere('f.id IN (:format)')
            ->setParameter('format', $search->format)
        ;
        }

        if (!empty($search->marque)) {
        $query = $query
            ->andWhere('m.id IN (:marques)')
            ->setParameter('marques', $search->marque)
        ;
        }

        if (!empty($search->decade)) {
        $query = $query
            ->andWhere('c.decade IN (:decade)')
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

   public function getModeleQueryBuilder($marqueId)
    {
        return $this->createQueryBuilder('b')
                ->leftJoin('b.marque', 'e')
                ->addSelect('e')
                ->where("e.id = :id")
                ->setParameter('id', $marqueId)
                ;
 
    }
}
