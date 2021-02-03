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
        

        return $this->render('home/index.html.twig', [
            
        ]);
    }
}
