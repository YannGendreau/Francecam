<?php
namespace App\Controller;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    { 
        $form = $this->createForm(ContactType::class, new Contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            $message = (new TemplatedEmail())
            ->from(new Address($this->getParameter("mail.admin"), 'Francecam Admin'))
            ->to(new Address($this->getParameter("mail.admin"), 'Francecam Admin'))
            ->subject('vous avez reçu un email de' .$contactFormData->getNom())
            ->htmlTemplate('contact/message.html.twig')
            ->context([
                'contact' => $contactFormData
            ]);
            $mailer->send($message);
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('accueil');
        }
        return $this->render('contact/index.html.twig', [
            'contact_form' => $form->createView()
        ]);
    }
    
}