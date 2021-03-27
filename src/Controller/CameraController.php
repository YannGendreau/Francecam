<?php

namespace App\Controller;

use App\Entity\Camera;
use App\Form\Camera1Type;
use App\Repository\CameraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/camera")
 */
class CameraController extends AbstractController
{
    /**
     * @Route("/", name="camera_index", methods={"GET"})
     */
    public function index(CameraRepository $cameraRepository): Response
    {
        return $this->render('camera/index.html.twig', [
            'cameras' => $cameraRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="camera_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $camera = new Camera();
        $form = $this->createForm(Camera1Type::class, $camera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($camera);
            $entityManager->flush();

            return $this->redirectToRoute('camera_index');
        }

        return $this->render('camera/new.html.twig', [
            'camera' => $camera,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="camera_show", methods={"GET"})
     */
    public function show(Camera $camera): Response
    {
        return $this->render('camera/show.html.twig', [
            'camera' => $camera,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="camera_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Camera $camera): Response
    {
        $form = $this->createForm(Camera1Type::class, $camera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('camera_index');
        }

        return $this->render('camera/edit.html.twig', [
            'camera' => $camera,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="camera_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Camera $camera): Response
    {
        if ($this->isCsrfTokenValid('delete'.$camera->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($camera);
            $entityManager->flush();
        }

        return $this->redirectToRoute('camera_index');
    }
}
