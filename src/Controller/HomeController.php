<?php

namespace App\Controller;

use App\Data\FilmSearchData;
use App\Data\SearchHomeData;
use App\Form\SearchFilmForm;
use App\Form\SearchHomeType;
use App\Form\SearchFilmCameraType;
use App\Repository\FilmRepository;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        //Barre de recherche
        //init data
        $data = new SearchHomeData;
        //paginator
        $data->page =$request->get('page', 1);
        //génère le formulaire 
        $form = $this->createForm(SearchHomeType::class, $data);
        //appelle la requète
        $form->handleRequest($request);
        //déclare les variables findhomesearch
        $films = $filmRepository->findHomeSearch($data);
        $marque = $marqueRepository->findHomeSearch($data);
        $modele = $modeleRepository->findHomeSearch($data);
      
        //validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            //retourne le rendu des requètes de recherche
            return $this->render('search_home/index.html.twig', [
                
                'films' => $films,
                'marque' => $marque,
                'modele' => $modele,

            ]);
        }
            //retourne un rendu des requètes et la barre de recherche
            return $this->render('home/index.html.twig', [
            'modele' => $modeles,
            'resultFilm' => $filmResults,
            'form' => $form->createView()
        ]);
    }

}
