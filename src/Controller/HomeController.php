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
    // public function index( ModeleRepository $modeleRepository, FilmRepository $filmRepository, MarqueRepository $marqueRepository ,Request $request): Response
    // {
    //     //Toutes les cameras et films
    //     $cameras = $modeleRepository->findAll();
    //     $films = $filmRepository->findAll();

    //     $form = $this->createForm(SearchFilmCameraType::class);
        
    //     $search = $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid()){
    //         // On recherche les annonces correspondant aux mots clés
    //         $films = $filmRepository->search(
    //             $search->get('mots')->getData()
    //         );
    //         $marques = $marqueRepository->search(
    //             $search->get('mots')->getData()
             
    //         );
    //         $modeles = $modeleRepository->search(
    //             $search->get('mots')->getData()
             
    //         );

    //         return $this->render('search_home/index.html.twig', [
                
    //             'films' => $films,
    //             'marques' => $marques,
    //             'modeles' => $modeles
    //         ]);

    //     }

    //     return $this->render('home/index.html.twig', [
    //         'cameras' => $cameras,
    //         'films' => $films,
    //         'form' => $form->createView()
    //     ]);
    // }
    public function index( ModeleRepository $modeleRepository, FilmRepository $filmRepository, MarqueRepository $marqueRepository ,Request $request, SearchHomeData $search): Response
    {
       
        $cameras = $modeleRepository->findAll();
        $films = $filmRepository->findAll();
        $data = new SearchHomeData;
        $data->page =$request->get('page', 1);
        $form = $this->createForm(SearchHomeType::class, $data);
        $form->handleRequest($request);
        $film = $filmRepository->findHomeSearch($data);
        $marque = $marqueRepository->findHomeSearch($data);
        $modeles = $modeleRepository->findHomeSearch($data);
      
        // if ($request->isXmlHttpRequest()){
        //     return new JsonResponse([
        //         'content' => $this->renderView('film/_film_list.html.twig', ['films' =>$films]),
        //         'sorting' => $this->renderView('film/_sorting.html.twig', ['films' =>$films])
        //     ]);
        // }


        // if ($films) {
        //     throw new NotFoundHttpException('Pas de films');
        // }

        if ($form->isSubmitted() && $form->isValid()) {
       
            return $this->render('search_home/index.html.twig', [
                
                // 'films' => $films,
                'film' => $film,
                'marque' => $marque,
                'modeles' => $modeles,
                // 'marques' => $marques,
                // 'modeles' => $modeles
            ]);
        }
        

        return $this->render('home/index.html.twig', [
            'cameras' => $cameras,
            'films' => $films,
            'form' => $form->createView()
        ]);
    }

}
