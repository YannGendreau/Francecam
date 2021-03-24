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
       //renvoie tous les cameras et films 
        $modeles = $modeleRepository->modeleByDateDesc();
        $films = $filmRepository->filmByDateDesc();

        //Barre de recherche
        $data = new SearchHomeData;
        $data->page =$request->get('page', 1);
        $form = $this->createForm(SearchHomeType::class, $data);
        $form->handleRequest($request);
        $films = $filmRepository->findHomeSearch($data);
        $marque = $marqueRepository->findHomeSearch($data);
        $modele = $modeleRepository->findHomeSearch($data);
      
        if ($form->isSubmitted() && $form->isValid()) {
       
            return $this->render('search_home/index.html.twig', [
                
                'films' => $films,
                'marque' => $marque,
                'modele' => $modele,

            ]);
        }
        

        return $this->render('home/index.html.twig', [
            'modele' => $modeles,
            'films' => $films,
            'form' => $form->createView()
        ]);
    }

}
