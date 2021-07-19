<?php

namespace App\Controller;

use App\Repository\CameraRepository;
use App\Repository\FilmRepository;
use App\Repository\MarqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     */
    public function index(
        Request $request,
        FilmRepository $filmRepository,
        CameraRepository $cameraRepository,
        MarqueRepository $marqueRepository
        ): Response
    {
        
        $hostname = $request->getSchemeAndHttpHost();
        $urls = [];
        $urls[] = ['loc'=>$this->generateUrl('accueil')];
        $urls[] = ['loc'=>$this->generateUrl('films')];
        $urls[] = ['loc'=>$this->generateUrl('camera')];
        $urls[] = ['loc'=>$this->generateUrl('marque_index')];
        $urls[] = ['loc'=>$this->generateUrl('about')];
        $urls[] = ['loc'=>$this->generateUrl('contact')];
        $urls[] = ['loc'=>$this->generateUrl('app_login')];
        $urls[] = ['loc'=>$this->generateUrl('app_register')];

        foreach($filmRepository->findAll() as $film){
            $urls[] = [
                'loc' => $this->generateUrl('film_show', ['slug' => $film->getSlug()]),
                'lastmod' => $film->getCreatedAt()->format('Y-m-d')
            ];
        }
        foreach($cameraRepository->findAll() as $camera){
            $urls[] = [
                'loc' => $this->generateUrl('camera_show', ['slug' => $camera->getSlug()]),
            ];
        }
        foreach($marqueRepository->findAll() as $marque){
            $urls[] = [
                'loc' => $this->generateUrl('marque_show', ['slug' => $marque->getSlug()])
            ];
        }

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname,
            ]),
            200
        );

        $response->headers->set('Content-type', 'text/xml');

        return $response;
    }
}
