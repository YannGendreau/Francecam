<?php

namespace App\Repository;

use App\Entity\Modele;
use App\Data\SearchHomeData;
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

    // /**
    //  * @return Modele[] Returns an array of Modele objects
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
    public function findOneBySomeField($value): ?Modele
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
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
            20

        );      
    }
}
