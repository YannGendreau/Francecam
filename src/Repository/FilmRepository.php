<?php

namespace App\Repository;

use App\Entity\Film;
use App\Data\FilmSearchData;
use App\Data\SearchHomeData;
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
    * recherche par filtre retournant une interface de pagination
    * 
    * @return PaginationInterface
    */

    public function findSearch(FilmSearchData $search): PaginationInterface
    {
        //Sélection des champs sur FilmSearchData
        $query = $this
                    ->createQueryBuilder('f') //Créé une instance de QueryBuilder avec alias
                    ->select('f','m', 'g', 'n', 'c', 'd', 'p') // Sélectionne les items à retourner dans les résultat de requêtes
                    ->leftJoin('f.genres', 'g') //Joint la relation film.genres avec un alias
                    ->leftJoin('f.camera', 'c') //Joint la relation film.modeles avec un alias
                    ->leftJoin('c.marque', 'm') //Joint la relation film.marques avec un alias
                    ->leftJoin('c.modele', 'n') //Joint la relation film.modeles avec un alias
                    ->leftJoin('f.directors', 'd') //Joint la relation film.modeles avec un alias
                    ->leftJoin('f.dirphoto', 'p') //Joint la relation film.modeles avec un alias
                    ->orderBy('f.createdAt', 'DESC')
                    
                   //évite le problème typique de n+1 de Symfony en joignant les requêtes
                    ;

        // RECHERCHE TEXTE PARTIELLE
        //Si la propriété q n'est pas vide on effectue la requête          
        if (!empty($search->q)) {
            $query = $query
                    ->andWhere('f.title LIKE :q')//Le texte comporte une partie du titre.  
                    ->orWhere('d.Name LIKE :q')//Le texte comporte une partie du titre.  
                    ->orWhere('p.name LIKE :q')//Le texte comporte une partie du titre.  
                    ->setParameter('q', "%{$search->q}%") // Désigne 'q' comme alias de la propriété q partielle, début de mot
                    ;
        }

        //CHECKBOXES
        //Si la propriété genres n'est pas vide on effectue la requête 
        if (!empty($search->genres)) {
            $query = $query
            ->andWhere('g.id IN (:genres)') //recherche par id dans la propriété genres
            ->setParameter('genres', $search->genres) // Désigne 'genres' comme alias de la propriété genres
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
        if (!empty($search->modeles)) {
            $query = $query
            ->andWhere('n.id IN (:modeles)')
            ->setParameter('modeles', $search->modeles)
            ;
        }
        if (!empty($search->camera)) {
            $query = $query
            ->andWhere('c.id IN (:camera)')
            ->setParameter('camera', $search->camera)
            ;
        }
        //envoie les resultats vers paginator pour pagination
            $query= $query->getQuery();//Récupère la requête du QueryBuilder
            return $this->paginator->paginate(
            $query,
            $search->page,
            60

        );      
    }


    /**
     * Barre de recherche; Query sur les champs Film
     * Même procédé que pour la recherche sur la route /film
     *
     * @param SearchHomeData $search
     */
    public function findHomeSearch(SearchHomeData $search)
    {
        $query = $this
                    ->createQueryBuilder('f')
                    ->select('f')
                    ->leftJoin('f.camera', 'c')
                    ->leftJoin('c.marque', 'm')
                    ;

        if (!empty($search->r)) {
            $query = $query
                    ->andWhere('f.title LIKE :r')
                    ->setParameter('r', "%{$search->r}%")
                    ;
        }       
       
            $query= $query->getQuery();

        return $query->getResult(); 
    }

    public function groupCameraByMarque(){

        return $this->createQueryBuilder('f')
        ->select('f.camera', 'c')
        ->orderBy('c.name', 'ASC')
        ->getQuery()
        ->execute()
    ;
    }

      
}
