<?php

namespace App\Data;

use App\Entity\Modele;
use App\Entity\Marque;
use Doctrine\ORM\Mapping\OrderBy;


class CameraSearchData{


    /**
     * Champ de recherche
     *
     * @var string
     */
    public $q = '';

    /**
     * Tableau de genres
     *
     * @var Modele
     */
    public $modele = [];

    /**
     * Tableau de date de sortie
     *
     * @var int[]
     */
    public $annee;


    /**
     *Tableau de date de marque de caméras
     *
     * @var Marque
     */
    public $marque = [];


    /**
     * Tableau de décennies
     *
     * @var Modele[]
     */
    public $decade = [];

    /**
     * Tableau de décennies
     *
     * @var Modele[]
     */
    public $sortie = [];

    
}