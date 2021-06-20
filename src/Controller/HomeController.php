<?php

namespace App\Controller;

use App\Data\SearchHomeData;
use App\Repository\FilmRepository;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */

    public function index( ModeleRepository $modeleRepository, FilmRepository $filmRepository, MarqueRepository $marqueRepository ,Request $request, SearchHomeData $search): Response
    {
        //renvoie toutes les cameras et films par date desc
        $modeles = $modeleRepository->modeleByDateDesc();
        $filmResults = $filmRepository->filmByDateDesc();

        //retourne un rendu des requètes et la barre de recherche
        return $this->render('home/index.html.twig', [
            'modele' => $modeles,
            'resultFilm' => $filmResults,
        ]);
    }
}
