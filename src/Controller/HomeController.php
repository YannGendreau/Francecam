<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use App\Repository\CameraRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */

    public function index( CameraRepository $cameraRepository, FilmRepository $filmRepository ): Response
    {
        //renvoie toutes les cameras et films par date desc
        $cameras = $cameraRepository->modeleByDateDesc();
        $filmResults = $filmRepository->filmByDateDesc();

        //retourne un rendu des requètes et la barre de recherche
        return $this->render('home/index.html.twig', [
            'cameras' => $cameras,
            'resultFilm' => $filmResults,
        ]);
    }
}
