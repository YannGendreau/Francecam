<?php

namespace App\Controller;

use App\Entity\Camera;
use App\Form\CameraType;
use App\Data\CameraSearchData;
use App\Form\SearchCameraForm;
use App\Repository\CameraRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/camera")
 */
class CameraController extends AbstractController
{

  /**
     * @var CameraRepository
     */

    private $repository;

    public function __construct(CameraRepository $repository)
    {
        $this->repository = $repository;
    }



     /**
     * @Route("/", name="camera", methods={"GET"})
     */
    public function filmList(Request $request): Response
    {        
        $data = new CameraSearchData;
        $data->page =$request->get('page', 1);
        $form = $this->createForm(SearchCameraForm::class, $data);
        $form->handleRequest($request);
        $cameras = $this->repository->findSearch($data);
        if ($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('camera/_camera_list.html.twig', ['cameras' => $cameras]),
                'sorting' => $this->renderView('camera/_sorting.html.twig', ['cameras' => $cameras]),
                'pagination' => $this->renderView('camera/_pagination.html.twig', ['cameras' => $cameras]),
                'pages' => ceil($cameras->getTotalItemCount() / $cameras->getItemNumberPerPage())
            ]);
        }

        if(!$cameras){
            throw new NotFoundHttpException('Pas de films');
        }

        return $this->render('camera/camera_list.html.twig', [
            "cameras" => $cameras,
            'form' => $form->createView()
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
