<?php

namespace App\Data;

use App\Entity\Format;
use App\Entity\Marque;
use App\Entity\Modele;
use Doctrine\ORM\Mapping\OrderBy;


class CameraSearchData{


    /**
     * Champ de recherche
     *
     * @var string
     */
    public $q = '';

    /**
     * Tableau de Modele
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
     * @var Marque[]
     */
    public $decade = [];

    /**
     * Tableau de sortie
     *
     * @var Modele[]
     */
    public $sortie = [];

    /**
     * Tableau de formats
     *
     * @var Format[]
     */
    public $format = [];

    
}