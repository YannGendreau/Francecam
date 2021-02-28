<?php

namespace App\Data;

use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Marque;
use App\Entity\Modele;
use Doctrine\ORM\Mapping\OrderBy;


class FilmSearchData
{
    /**
     * Undocumented variable
     *
     * @var integer
     */
    public $page;

    /**
     * Champ de recherche
     *
     * @var string
     */
    public $q = '';

    /**
     * Tableau de genres
     *
     * @var Genre
     */
    public $genres = [];

    /**
     * Tableau de date de sortie
     *
     * @var int[]
     */
    public $annee;


    /**
     * Tableau de date de sortie
     *
     * @var array
     * 
     */
    public $sortie ;

    /**
     *Tableau de date de marque de caméras
     *
     * @var Marque
     */
    public $marques = [];

    // public $sortie;

    /**
     * Tableau de décennies
     *
     * @var Film[]
     */
    public $decade = [];



    // public function __toString()
    // {
    //     return $this->sortie;
    // }

//     public function getAnnee($annee)
// {
    
//     return substr($annee, 0, 3) . '';
// }

    // /**
    //  * Get undocumented variable
    //  *
    //  * @return  string
    //  */ 
    // public function getQ()
    // {
    //     return $this->q;
    // }

    // /**
    //  * Set undocumented variable
    //  *
    //  * @param  string  $q  Undocumented variable
    //  *
    //  * @return  self
    //  */ 
    // public function setQ(?string $q)
    // {
    //     $this->q = $q;

    //     return $this;
    // }

    // /**
    //  * Get tableau de genres
    //  *
    //  * @return  array
    //  */ 
    // public function getGenres()
    // {
    //     return $this->genres;
    // }

    // /**
    //  * Set tableau de genres
    //  *
    //  * @param  array  $genres  Tableau de genres
    //  *
    //  * @return  self
    //  */ 
    // public function setGenres(array $genres)
    // {
    //     $this->genres = $genres;

    //     return $this;
    // }

    // /**
    //  * Undocumented function
    //  *
    //  * @param Film $annee
    //  * @return string
    //  */    
    // public function yearFloor(Film $annee):string
    //     {
    //         return floor($annee);
    //     }
    
}