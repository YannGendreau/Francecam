<?php

namespace App\Controller;

use App\Form\UserRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{

    public const LAST_EMAIL = 'app_login_form_last_email';

    /**
     * @Route("/register", name="app_register", methods={"GET", "POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UserRegistrationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plainPassword = $form['plainPassword']->getData();

            $user->setPassword($passwordEncoder->encodePassword($user, $plainPassword));
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Bienvenue sur Francecam ! Votre compte à bien été crée. ');

            return $this->redirectToRoute('accueil');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(): Response
    {
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');

        $this->addFlash('info', 'Vous avez bien été déconnecté.');

        //Redirection vers la page de connexion
        return $this->redirectToRoute('app_login');
    }

    /**
     * Route cible après déconnection: permet d'ajouter un message flash
     * @Route("/logout-message", name="app_logout_message")
     */
    public function logoutMessage(){
        //Ajout d'un message flash
        $this->addFlash('info', 'Vous avez bien été déconnecté.');

        //Redirection vers la page de connexion
        return $this->redirectToRoute('app_login');
    }
}
