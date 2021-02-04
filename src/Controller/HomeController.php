<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Gamme;
use App\Entity\Marque;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {

        
        // $film = new Film;
        // $marque = new Marque;

        // $film->setTitle('Symfony');
        // $film->setDuree(123);
        // $film->setSynopsis("C'est l'histoire d'un type qui apprend Symfony");
        // $film->setSortie(2021);
        // $film->addMarque($marque->setName('Canon'));
        // $entityManager = $this->getDoctrine()->getManager(); 
        // $entityManager->persist($film);
        
        // $entityManager->flush();
    

        return $this->render('home/index.html.twig', [
            
        ]);
    }
}
