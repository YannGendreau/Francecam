<?php

namespace App\Controller;

use App\Entity\Cameras;
use App\Form\CamerasType;
use App\Repository\CamerasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cameras")
 */
class CamerasController extends AbstractController
{
    /**
     * @Route("/", name="cameras_index", methods={"GET"})
     */
    public function index(CamerasRepository $camerasRepository): Response
    {
        return $this->render('cameras/index.html.twig', [
            'cameras' => $camerasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cameras_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $camera = new Cameras();
        $form = $this->createForm(CamerasType::class, $camera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($camera);
            $entityManager->flush();

            return $this->redirectToRoute('cameras_index');
        }

        return $this->render('cameras/new.html.twig', [
            'camera' => $camera,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="cameras_show", methods={"GET"})
     */
    public function show(Cameras $camera): Response
    {
        return $this->render('cameras/show.html.twig', [
            'camera' => $camera,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="cameras_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cameras $camera): Response
    {
        $form = $this->createForm(CamerasType::class, $camera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cameras_index');
        }

        return $this->render('cameras/edit.html.twig', [
            'camera' => $camera,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="cameras_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cameras $camera): Response
    {
        if ($this->isCsrfTokenValid('delete'.$camera->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($camera);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cameras_index');
    }
}
