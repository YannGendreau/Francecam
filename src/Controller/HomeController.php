<?php

namespace App\Controller;


use App\Form\SearchFilmCameraType;
use App\Repository\FilmRepository;
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
    public function index( ModeleRepository $modeleRepository, FilmRepository $filmRepository, Request $request): Response
    {
        //Toutes les cameras et films
        $cameras = $modeleRepository->findAll();
        $films = $filmRepository->findAll();

        $form = $this->createForm(SearchFilmCameraType::class);
        
        $search = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On recherche les annonces correspondant aux mots clés
            $filmsearch = $filmRepository->search(
                $search->get('mots')->getData(),
             
            );

        return $this->redirectToRoute('search_show');

        }

        return $this->render('home/index.html.twig', [
            'cameras' => $cameras,
            'films' => $films,
            'form' => $form->createView()
        ]);
    }
    

}
