<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/user", name="admin_")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * Liste des utilisateurs 
     *
     * @return void
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function userList(UserRepository $users){
        return $this->render("admin/users.html.twig", [
            'users' => $users->findAll()
        ]);

    }
}
