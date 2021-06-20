<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Data\SearchHomeData;
use App\Repository\FilmRepository;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function searchBar(ModeleRepository $modeleRepository, FilmRepository $filmRepository, MarqueRepository $marqueRepository, Request $request, SearchHomeData $search)
    {
        //Barre de recherche
        //init data
        $data = new SearchHomeData;
        //paginator
        $data->page =$request->get('page', 1);
        //génère le formulaire
        $form = $this->createForm(SearchType::class, $data);
        //appelle la requète
        $form->handleRequest($request);
        //déclare les variables findhomesearch
        $films = $filmRepository->findHomeSearch($data);
        $marque = $marqueRepository->findHomeSearch($data);
        $modele = $modeleRepository->findHomeSearch($data);
      
        //validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            //retourne le rendu des requètes de recherche
            return $this->render('search/results.html.twig', [
                
                'films' => $films,
                'marque' => $marque,
                'modele' => $modele,

            ]);
        }
        // dd($form);

        return $this->render('search/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}