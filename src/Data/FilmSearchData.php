<?php

namespace App\Data;

use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Camera;
use App\Entity\Marque;
use Doctrine\ORM\Mapping\OrderBy;


class FilmSearchData
{
    /**
     * Page pour paginator
     *
     * @var integer
     */
    public $page;

    /**
     * Champ de recherche texte
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
     *Tableau de marque de caméras
     *
     * @var Marque
     */
    public $marques = [];
    /**
     *Tableau de modeles de caméras
     *
     * @var Modele
     */
    public $modeles = [];

    // public $sortie;

    /**
     * Tableau de décennies
     *
     * @var Film[]
     */
    public $decade = [];
    /**
     * Tableau de cameras
     *
     * @var Camera[]
     */
    public $camera = [];

    
}