<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Mailer;
use App\Form\UserRegistrationFormType;
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
     * @Route("/register", name="app_register", methods={"GET", "POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        // Déclaration du formulaire
        $form = $this->createForm(UserRegistrationFormType::class);
        // Requête
        $form->handleRequest($request);
        // Validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // user = les informations du formulaire
            $user = $form->getData();
            // plainPassword = le mot de passe du formulaire
            $plainPassword = $form['plainPassword']->getData();
            // Hash le mot de passe
            $user->setPassword($passwordEncoder->encodePassword($user, $plainPassword));
            //token d'activation chiffré
            $user->setActivationToken(md5(uniqid()));
            // écrire en BDD
            $em->persist($user);
            $em->flush();

            // email avec token
            $email = (new TemplatedEmail())
            ->from(new Address($this->getParameter("mail.admin"), 'Francecam'))
            ->to($user->getEmail())
            ->subject('Francecam | Votre lien d\'activation de compte')
            ->htmlTemplate('email/activation.html.twig')
            ->context([
                'token' => $user->getActivationToken()
            ])
        ;
        // envoie l'e-mail avec mailer
        $mailer->send($email);

            return $this->redirectToRoute('activation_sent');
            // $this->addFlash('success', 'Bienvenue sur Francecam ! Votre compte à bien été crée. ');  
        }
        //rendu Twig
        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }

    /**
     * Message d'envoi de lien de connexion
     * @Route("/activation/sent", name="activation_sent")
     */
    public function activationSent()
    {
        return $this->render('email/activation_message.html.twig');
    }

    /**
     * Met le token a NULL si le lien est cliqué
     * @Route("/activation/{token}", name="activation")
     */
    public function activation(
        $token,
        UserRepository $userRepository,
        MailerInterface $mailer
        )
    {
        // User = l'utilisateur par token
        $user = $userRepository->findOneBy(['activation_token' => $token]);
        // Renvoie une erreur si le token ne correspond pas  
        if(!$user){
            throw $this->createNotFoundException('L\'utilisateur n\'existe pas.');
        }
        // Annule le token
        $user->setActivationToken(null);
        // écrit en BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // EMAIL
        $email = (new TemplatedEmail())
        ->from(new Address($this->getParameter('mail.admin'), 'Francecam Admin'))
        ->to(new Address($this->getParameter('mail.admin'), 'Francecam Admin'))
        ->subject('Francecam | Nouvel utilisateur'. ' ' . $user->getName())
        ->htmlTemplate('user/_user_register.html.twig')
        ->context([
            'user' => $user
        ])
        ;

        $mailer->send($email);

        // message Flash
        $this->addFlash('success', 'Bienvenue sur Francecam ! Votre compte a bien été crée.');
        // redirection
        return $this->redirectToRoute('accueil');
    }

    /**
     * Formulaire de connexion
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(Request $request): Response
    {
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
            'back_to_your_page' => $request->headers->get('referer')
        ]);
    }

    
    /**
     * Déconnexion
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');

        $this->addFlash('info', 'Vous avez bien été déconnecté.');

        //Redirection vers la page de connexion
        return $this->redirectToRoute('app_login');
    }

}
