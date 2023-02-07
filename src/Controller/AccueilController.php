<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('accueil/about.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer)
    {
        // on crée le formulaire à partir de ContactType
        $form = $this->createForm(ContactType::class);

        $contact = $form->handleRequest($request);

        // on injecte les données du formulaire dans un tempplate contact_mail.html.twig
        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
                ->from($contact->get('email')->getData())
                ->to('test@domain.com')
                ->subject('Contact depuis le site Projet Apprenant')
                ->htmlTemplate('emails/contact_mail.html.twig')
                ->context([
                    'nom' => $contact->get('nom')->getData(),
                    'prenom' => $contact->get('prenom')->getData(),
                    'mail' => $contact->get('email')->getData(),
                    'objet' => $contact->get('objet')->getData(),
                    'message' => $contact->get('message')->getData(),
                ]);

            // on envoie l'email
            $mailer->send($email);
            
            // on invoque le message flash de confirmation
            $this->addFlash('message', 'Votre e-mail a bien été envoyé');

            // on redirige vers la page elle-même
            return $this->redirectToRoute('app_contact');
            
        }

        return $this->render('accueil/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
