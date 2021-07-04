<?php

namespace App\Controller;

use App\Entity\Modele;
use App\Form\ModeleType;
use App\Data\CameraSearchData;
use App\Form\SearchCameraForm;
use App\Repository\ModeleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/modele")
 */
class ModeleController extends AbstractController
{

      /**
     * @var ModeleRepository
     */

    private $repository;

    public function __construct(ModeleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/new", name="modele_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $modele = new Modele();
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modele);
            $entityManager->flush();

            return $this->redirectToRoute('modele_index');
        }

        return $this->render('modele/new.html.twig', [
            'modele' => $modele,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="modele_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Modele $modele): Response
    {
        
        return $this->render('modele/show.html.twig', [
            'modele' => $modele
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="modele_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Modele $modele): Response
    {
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('modele_index');
        }

        return $this->render('modele/edit.html.twig', [
            'modele' => $modele,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="modele_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Modele $modele): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modele->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($modele);
            $entityManager->flush();
        }

        return $this->redirectToRoute('modele_index');
    }

     /**
     * @Route("/", name="modele", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function filmList(Request $request): Response
    {        
        $data = new CameraSearchData;
        $data->page =$request->get('page', 1);
        $form = $this->createForm(SearchCameraForm::class, $data);
        $form->handleRequest($request);
        $modeles = $this->repository->findSearch($data);
        if ($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('modele/_modele_list.html.twig', ['modele' => $modeles]),
                'sorting' => $this->renderView('modele/_sorting.html.twig', ['modele' => $modeles]),
                'pagination' => $this->renderView('modele/_pagination.html.twig', ['modele' => $modeles]),
                'pages' => ceil($modeles->getTotalItemCount() / $modeles->getItemNumberPerPage())
            ]);
        }

        if(!$modeles){
            throw new NotFoundHttpException('Pas de films');
        }

        return $this->render('modele/modele_list.html.twig', [
            "modele" => $modeles,
            'form' => $form->createView()
        ]);
    }
}
