<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Mailer;
use App\Form\UserRegistrationFormType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{

    //permet de garder en mémoire le dernier email 
    public const LAST_EMAIL = 'app_login_form_last_email';

    /**
     * Page d'inscription 
     * 
     * @Route("/register", name="app_register", methods={"GET", "POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $form = $this->createForm(UserRegistrationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plainPassword = $form['plainPassword']->getData();
        
            $user->setPassword($passwordEncoder->encodePassword($user, $plainPassword));

            //token d'activation chiffré
            $user->setActivationToken(md5(uniqid()));

            $em->persist($user);
            $em->flush();

            // email avec token
            $email = (new TemplatedEmail())
            ->from(new Address('yanngendreau@gmail.com', 'Francecam Admin'))
            ->to($user->getEmail())
            ->subject('Francecam | Votre lien d\'activation de compte')
            ->htmlTemplate('email/activation.html.twig')
            ->context([
                'token' => $user->getActivationToken()
            ])
        ;

        $mailer->send($email);

            // $this->addFlash('success', 'Bienvenue sur Francecam ! Votre compte à bien été crée. ');

            return $this->redirectToRoute('activation_sent');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }

    /**
     * Message d'envoi de lien de connexion
     *
     * @Route("/activation/sent", name="activation_sent")
     */
    public function activationSent()
    {
        return $this->render('email/activation_message.html.twig');
    }

    /**
     * Met le token a NULL si le lien est cliqué
     * 
     * @Route("/activation/{token}", name="activation")
     *
     */
    public function activation($token, UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy(['activation_token' => $token]);
      

        if(!$user){
            throw $this->createNotFoundException('L\'utilisateur n\'existe pas.');

        }
      

        $user->setActivationToken(null);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash('success', 'Bienvenue sur Francecam ! Votre compte a bien été crée.');

        return $this->redirectToRoute('accueil');
    }

    /**
     * Formulaire de connexion
     * 
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(): Response
    {
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    
    /**
     * Déconnexion
     * 
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
    // public function logoutMessage(){
    //     //Ajout d'un message flash
    //     $this->addFlash('info', 'Vous avez bien été déconnecté.');

    //     //Redirection vers la page de connexion
    //     return $this->redirectToRoute('app_login');
    // }
}
