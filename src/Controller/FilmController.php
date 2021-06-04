<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\User;
use App\Entity\Camera;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Form\FilmType;
use App\Data\FilmSearchData;
use App\Form\SearchFilmForm;
use App\Repository\FilmRepository;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
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
     * NOUVEAU FILM
     * @Route("/new", name="film_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, MailerInterface $mailer ): Response
    {
        $film = new Film;

        // $em = $this->getDoctrine()->getManager();
       
        $camera = new ArrayCollection();
        foreach ($film->getCamera() as $cam) {
            $camera->add($cam);
        }
               
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $film->setUser($this->getUser());
/*-----------------------------------------------------------------------
TEST 
            // foreach ($camera as $cam) {
            //     // vérifie si cam est bien dans le $film->getCamera()
            //     if ($film->getCamera()->contains($cam) === false) {
            //         $em->remove($cam);
            //     }
            // }
            // $marque = $film->getCamera()->getMarque();
            // $modele = $film->getCamera()->getModele();
             // $film->addMarque($marque);
            // $film->addModele($modele);
------------------------------------------------------------------------*/  
           
            $sortie = $film->getSortie();
            $film->setDecade($sortie);

            $entityManager = $this->getDoctrine()->getManager();        
            $film = $form->getData();
         
           
            //token d'activation chiffré
            // $film->setActivationToken(md5(uniqid()));

            $entityManager->persist($film);
            $entityManager->flush();
            // dd($film);

/*------------------------------------------------------------------------------
           EMAIL AVEC TOKEN (A L'ETUDE))
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
----------------------------------------------------------------------------------------*/
            $this->addFlash('success', 'Nouveau film enregistré');
       
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

    // /**
    //  * Met le token a NULL si le lien est cliqué (A L'ETUDE)
    //  * 
    //  * @Route("/activation/{token}", name="activation_film")
    //  *
    //  */
    // public function activation($token, FilmRepository $repository)
    // {
    //     $film = $repository->findOneBy(['activation_token' => $token]);

    //     if(!$film){
    //         throw $this->createNotFoundException('Le film n\'existe pas.');

    //     }

    //     $film->setActivationToken(null);
    //     $em = $this->getDoctrine()->getManager();
    //     $em->persist($film);
    //     $em->flush();

    //     $this->addFlash('success', 'Merci de votre contribution a Francecam !');

    //     return $this->redirectToRoute('film_show', ['slug' => $film->getSlug()]);
    // }

 
    /**
     * PRESENTATION DE FILM
     * @Route("/{slug}", name="film_show", methods={"GET"})
     */
    public function show(Film $film): Response
    {
        return $this->render('film/show.html.twig', [
            'film' => $film,
        ]);
    }

    /**
     * EDITER UN FILM
     * @Route("/{slug}/edit", name="film_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Film $film, EntityManagerInterface $entityManager, $slug): Response
    {
   
        $camera = new ArrayCollection();

        foreach ($film->getCamera() as $cam) {
            $camera->add($cam);
        }

        // Déclaration du formulaire FilmType
        $form = $this->createForm(FilmType::class, $film);
        // Requête
        $form->handleRequest($request);

        // Validation du formulaire
         if ($form->isSubmitted() && $form->isValid()) {

            foreach ($camera as $cam) {
                if (false === $film->getCamera()->contains($cam)) {
                    $cam->getFilms()->removeElement($film);
            
                    $entityManager->persist($cam);
                    // retire la caméra
                    $entityManager->remove($cam);
                }
            }
         
            //Enregistrement en base de données avec le manager de Doctrine  
            $this->getDoctrine()->getManager()->flush();
            //Message de succès 
            $this->addFlash('success', 'Film modifié avec succès');
            // Redirection
            return $this->redirectToRoute('film_show', ['slug' => $film->getSlug()]);
        }
        // Génération de rendu Twig
        return $this->render('film/edit.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }

    /**
     * SUPPRIME UN FILM
     * @Route("/{slug}", name="film_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Film $film): Response
    {
        //Vérifie si le token CSRF est valide, le manager supprime le film
        if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user');
    }

    /**
     * LISTE DES FILMS + FILTRES
     * @Route("/", name="films", methods={"GET"})
     */
    public function filmList(Request $request): Response
    {
        // instanciation des données de recherches (Film, Marque, Genre)
        $data = new FilmSearchData;
        $data->page = $request->get('page', 1);
        // Déclaration du formulaire SearchFilmForm
        $form = $this->createForm(SearchFilmForm::class, $data);
        // Requête
        $form->handleRequest($request);
        // Déclaration de la méthode findSearch (filmRepository)
        $films = $this->repository->findSearch($data);
        // Vérifie si la requête reçoit Ajax
        if ($request->get('ajax')){
            // retourne une réponse en Json de
            return new JsonResponse([
                //la liste des films
                'content' => $this->renderView('film/_film_list.html.twig', ['films' =>$films]),
                // classement par date
                'sorting' => $this->renderView('film/_sorting.html.twig', ['films' =>$films]),
                //La pagination
                'pagination' => $this->renderView('film/_pagination.html.twig', ['films' =>$films]),
                //Paginator; nombre d'item total divisé par le nombre d'item par page
                'pages' => ceil($films->getTotalItemCount() / $films->getItemNumberPerPage())
            ]);
        }
        // S'il n'y a pas de films correspondants à la recherche
        if(!$films){
            // renvoie une exception
            throw new NotFoundHttpException('Pas de films');
        }
        // Génération de rendu Twig
        return $this->render('film/film_list.html.twig', [
            "films" => $films,
            'form' => $form->createView()
        ]);
    }

}
