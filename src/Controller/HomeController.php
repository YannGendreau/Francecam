<?php

namespace App\Controller;


use App\Repository\FilmRepository;
use App\Repository\CamerasRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(CamerasRepository $cameraRepository, FilmRepository $filmRepository): Response
    {
        //Toutes les cameras et films
        $cameras = $cameraRepository->findAll();
        $films = $filmRepository->findAll();

        return $this->render('home/index.html.twig', [
            'cameras' => $cameras,
            'films' => $films
        ]);
    }

    
}
