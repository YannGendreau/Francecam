<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchHomeController extends AbstractController
{
    /**
     * @Route("/search/home", name="search_show")
     */
    public function index(ModeleRepository $modeleRepository, FilmRepository $filmRepository, Request $request): Response
    {

        $films = $filmRepository->search();

        return $this->render('search_home/index.html.twig', [
            'films' => $films
        ]);
    }
}
