<?php

namespace App\Controller;

use App\Entity\Camera;
use App\Form\CameraType;
use App\Repository\CameraRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/camera")
 */
class CameraController extends AbstractController
{
    /**
     * @Route("/", name="camera_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(CameraRepository $cameraRepository): Response
    {
        return $this->render('camera/index.html.twig', [
            'cameras' => $cameraRepository->findAll(),
        ]);
    }

    /**
     * Nouvelle caméra
     * @Route("/new", name="camera_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $camera = new Camera();
       
        $form = $this->createForm(CameraType::class, $camera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marque = $camera->getMarque();
            $modele = $camera->getModele();
            $cameraName = $marque . ' ' . $modele;
            $camera->setName($cameraName);
        
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
     * @Route("/{slug}", name="camera_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Camera $camera): Response
    {
        return $this->render('camera/show.html.twig', [
            'camera' => $camera,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="camera_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Camera $camera): Response
    {
        $form = $this->createForm(CameraType::class, $camera);
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
     * @Route("/{slug}", name="camera_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
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
