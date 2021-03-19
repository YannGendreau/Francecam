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

    
}