<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Marque;
use App\Form\FilmType;
use App\Data\FilmSearchData;
use App\Form\SearchFilmForm;
use App\Repository\FilmRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/film")
 */
class FilmController extends AbstractController
{

  /**
     * @var FilmRepository
     */

    private $repository;

    public function __construct(FilmRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/list", name="film_index", methods={"GET"})
     */
    public function index(FilmRepository $filmRepository): Response
    {
        return $this->render('film/index.html.twig', [
            'films' => $filmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="film_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request): Response
    {
        $film = new Film;
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        $sortie = $film->getSortie();
        $film->setDecade($sortie);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $film = $form->getData();
            $entityManager->persist($film);
            $entityManager->flush();

            $this->addFlash('success', 'Nouveau film enregistré');
       
            return $this->redirectToRoute('film_index');
        }
 
        return $this->render('film/new.html.twig', [
            // 'film' => $film,
            'form' => $form->createView(),
        ]);
    }

 
    /**
     * @Route("/{slug}", name="film_show", methods={"GET"})
     */
    public function show(Film $film): Response
    {
        return $this->render('film/show.html.twig', [
            'film' => $film,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="film_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Film $film): Response
    {
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        $sortie = $film->getSortie();
        $film->setDecade($sortie);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Film modifié avec succès');

            return $this->redirectToRoute('film_index');
        }

        return $this->render('film/edit.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="film_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Film $film): Response
    {
        if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('film_index');
    }

    /**
     * @Route("/", name="films", methods={"GET"})
     */
    public function filmList(Request $request): Response
    {
        // $films = $this->repository->findAll();
        
        $data = new FilmSearchData;
        $form = $this->createForm(SearchFilmForm::class, $data);
        $form->handleRequest($request);
      
        $films = $this->repository->findSearch($data);

        return $this->render('film/film_list.html.twig', [
            "films" => $films,
            'form' => $form->createView()
        ]);
    }

    private function toDecade(int $sortie)
    {
        return round($sortie/10, 0, PHP_ROUND_HALF_DOWN)* 10; 

    }
}
