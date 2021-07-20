<?php

namespace App\Controller;

use App\Entity\Film;
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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
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
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
                // Récupère l'utilisateur
                $film->setUser($this->getUser());
                // Récupère l'année de sortie...
                $sortie = $film->getSortie();
                // et l'injecte dans la méthode "décennie"
                $film->setDecade($sortie);
                // Appelle le manager de Doctrine
                $entityManager = $this->getDoctrine()->getManager();
                //Récupère les données du formulaire
                $film = $form->getData();
                //Persiste les données
                $entityManager->persist($film);
                //Enregistre en base de données
                $entityManager->flush();
            /*------------------------------------------------------------------------------*/  
                // EMAIL
                $email = (new TemplatedEmail())
                ->from(new Address($this->getParameter('mail.admin'), 'Francecam Admin'))
                ->to(new Address($this->getParameter('mail.admin'), 'Francecam Admin'))
                ->subject('Francecam | Nouveau film'. ' ' . $film->getTitle())
                ->htmlTemplate('film/activation.html.twig')
                ->context([
                    'film' => $film
                ])
            ;

                $mailer->send($email);
            /*----------------------------------------------------------------------------------------*/
                $this->addFlash('success', 'Nouveau film enregistré');
            
                return $this->redirectToRoute('film_show', ['slug' => $film->getSlug()]);
        }
            return $this->render('film/new.html.twig', [
                'film' => $film,
                'form' => $form->createView(),
            ]);
    }

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
    public function edit(Request $request, Film $film, MailerInterface $mailer, EntityManagerInterface $entityManager, $slug): Response
    {
   
    
        // Déclaration du formulaire FilmType
        $form = $this->createForm(FilmType::class, $film);
       
        // Requête
        $form->handleRequest($request);

        // Validation du formulaire
         if ($form->isSubmitted() && $form->isValid()) {
           
            //Enregistrement en base de données avec le manager de Doctrine  
            $this->getDoctrine()->getManager()->flush();
            //Message de succès
             // EMAIL
             $email = (new TemplatedEmail())
                ->from(new Address($this->getParameter('mail.admin'), 'Francecam'))
                ->to(new Address($this->getParameter('mail.admin'), 'Francecam Admin'))
                ->subject('Francecam | Modification du film'. ' ' . $film->getTitle())
                ->htmlTemplate('film/modification.html.twig')
                ->context([
                    'film' => $film
                ])
         ;

         $mailer->send($email);
         
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Film $film): Response
    {
        if ($film->getUser()) {
        //Vérifie si le token CSRF est valide, le manager supprime le film
            if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($film);
                $entityManager->flush();
            }
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
                'sorting' => $this->renderView('film/_sorting.html.twig', ['films' => $films]),
                //La pagination
                'pagination' => $this->renderView('film/_pagination.html.twig', ['films' => $films]),
              
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
