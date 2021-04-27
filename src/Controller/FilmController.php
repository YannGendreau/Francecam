<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\User;
use App\Entity\Camera;
use App\Entity\Marque;
use App\Form\FilmType;
use App\Data\FilmSearchData;
use App\Form\SearchFilmForm;
use App\Repository\FilmRepository;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @Route("/new", name="film_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, MailerInterface $mailer ): Response
    {
        $film = new Film;
        $camera = new Camera;
        
        $sortie = $film->getSortie();
        $film->setDecade($sortie);
        $film->addCamera($camera);

        
        // $modele =$camera->getModele();
       
        

        
        
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $film->setUser($this->getUser());

            $marque = $camera->getMarque();
            
            // $film->addModele($camera->getModele());

            $entityManager = $this->getDoctrine()->getManager();        
            $film = $form->getData();
            
            foreach($marque as $m){
                 $film->addMarque($m);
            };
           
            //token d'activation chiffré
            $film->setActivationToken(md5(uniqid()));

            $entityManager->persist($film);
            $entityManager->flush();

            // email avec token
            // $email = (new TemplatedEmail())
            // ->from(new Address('test@test.com', 'Francecam Admin'))
            // ->to(new Address('test@test.com', 'Francecam Admin'))
            // ->subject('Francecam | Nouveau film')
            // ->htmlTemplate('film/activation.html.twig')
            // ->context([
            //     'slug' => $film->getSlug(),
            //     'title' => $film->getTitle(),
            //     'user' => $film->getUser()
            // ])
            // ;

            // $mailer->send($email);

            // $this->addFlash('success', 'Nouveau film enregistré');
       
            return $this->redirectToRoute('film_show', ['slug' => $film->getSlug()]);
            // return $this->redirectToRoute('film_activation_sent');
        }
 
        return $this->render('film/new.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }


    

      /**
     * Message d'envoi de lien de connexion
     *
     * @Route("/activation/sent", name="film_activation_sent")
     */
    public function activationSent()
    {
        return $this->render('film/validation.html.twig');
    }

    /**
     * Met le token a NULL si le lien est cliqué
     * 
     * @Route("/activation/{token}", name="activation_film")
     *
     */
    public function activation($token, FilmRepository $repository)
    {
        $film = $repository->findOneBy(['activation_token' => $token]);

        if(!$film){
            throw $this->createNotFoundException('Le film n\'existe pas.');

        }

        $film->setActivationToken(null);
        $em = $this->getDoctrine()->getManager();
        $em->persist($film);
        $em->flush();

        $this->addFlash('success', 'Merci de votre contribution a Francecam !');

        return $this->redirectToRoute('film_show', ['slug' => $film->getSlug()]);
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
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Film $film, Camera $camera): Response
    {
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        $sortie = $film->getSortie();
        $film->setDecade($sortie);
        
 

        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Film modifié avec succès');

            // return $this->redirectToRoute('films');
            return $this->redirectToRoute('film_show', ['slug' => $film->getSlug()]);
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

        return $this->redirectToRoute('user');
    }

    /**
     * @Route("/", name="films", methods={"GET"})
     */
    public function filmList(Request $request): Response
    {
        // $films = $this->repository->findAll();
        
        $data = new FilmSearchData;
        $data->page =$request->get('page', 1);
        $form = $this->createForm(SearchFilmForm::class, $data);
        $form->handleRequest($request);
        $films = $this->repository->findSearch($data);
        if ($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('film/_film_list.html.twig', ['films' =>$films]),
                'sorting' => $this->renderView('film/_sorting.html.twig', ['films' =>$films]),
                'pagination' => $this->renderView('film/_pagination.html.twig', ['films' =>$films]),
                'pages' => ceil($films->getTotalItemCount() / $films->getItemNumberPerPage())
            ]);
}

        if(!$films){
            throw new NotFoundHttpException('Pas de films');
        }

        return $this->render('film/film_list.html.twig', [
            "films" => $films,
            'form' => $form->createView()
        ]);
    }

    private function toDecade(int $sortie)
    {
        return round($sortie/10, 0, PHP_ROUND_HALF_DOWN)* 10; 

    }

    /**
     * Undocumented function
     * @Route("/decennie", name="films_decade_30")
     *
     * @return void
     */
    public function decadeAction(Request $request, Film $films)
    {
        
        dd($request->query->get('decade'));
        return $this->render('film/film_validation.html.twig');
    }
}
