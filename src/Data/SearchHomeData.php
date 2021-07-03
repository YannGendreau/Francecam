<?php

namespace App\Data;

use App\Entity\Film;
use App\Entity\Marque;
use App\Entity\Modele;


class SearchHomeData
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
    public $r = '';

    /**
     * Tableau de genres
     *
     * @var Modele
     */
    public $modele = [];


    /**
     *Tableau de date de marque de caméras
     *
     * @var Marque
     */
    public $marques = [];

    /**
     *Tableau de film
     *
     * @var Film
     */
    public $film = [];


    
}