<?php

namespace App\Controller;


use App\Repository\FilmRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index( ModeleRepository $modeleRepository, FilmRepository $filmRepository): Response
    {
        //Toutes les cameras et films
        $cameras = $modeleRepository->findAll();
        $films = $filmRepository->findAll();

        return $this->render('home/index.html.twig', [
            'cameras' => $cameras,
            'films' => $films
        ]);
    }

    
}
