<?php

namespace App\Repository;

use App\Entity\Marque;
use App\Data\SearchHomeData;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Marque|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marque|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marque[]    findAll()
 * @method Marque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarqueRepository extends ServiceEntityRepository
{
       /**
     * Undocumented variable
     *
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry,  PaginatorInterface $paginator)
    {
        parent::__construct($registry, Marque::class);
        $this->paginator = $paginator;
    }

     /**
     * Recherche des films en cameras en fonction du formulaire
     * @return void 
     */
    public function search($mots = null){
        $query = $this->createQueryBuilder('m');
    
        if($mots != null){
            $query->andWhere('MATCH_AGAINST(m.name) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);
        }

        return $query->getQuery()->getResult();
    }

    /**
     * Query sur les champs Marque
     *
     * @param SearchHomeData $search
     * @return PaginationInterface
     */
    public function findHomeSearch(SearchHomeData $search): PaginationInterface
    {
        $query = $this
                    ->createQueryBuilder('m')
                    ->select('m','f', 'g')
                    ->leftJoin('m.films', 'f')
                    ->leftJoin('m.modeles', 'g')
                   
                    ;

        if (!empty($search->r)) {
            $query = $query
                    ->andWhere('m.name LIKE :r')
                    ->orWhere('f.title LIKE :r')
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
