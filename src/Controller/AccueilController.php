<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    public function contact(Request $request, MailerInterface $mailer, SluggerInterface $slugger)
    {
        $contact = new Contact();
        // on crée le formulaire à partir de ContactType
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        // on injecte les données du formulaire dans un tempplate contact_mail.html.twig
        if ($form->isSubmitted() && $form->isValid()) {

            // gestion du téléchargement du fichier
            /** @var UploadedFile $file */
            $file = $form->get('fichier')->getData();

            // condition obligatoire car 'fichier' n'est pas required
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // inclusion sécurisée du nom du fichier dans l'url
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // déplacement du fichier dans le dossier assets\contactFiles
                try {
                    $file->move(
                        $this->getParameter('fichiers_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // on invoque le message flash d'erreur'
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }

                // mettre à jour les propriétés de 'filename' pour stocker le nom du fichier pdf
                // à la place de son contenu
                $contact->setFilename($newFilename);
            }

            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('test@domain.com')
                ->subject('Contact depuis le site Projet Apprenant')
                ->htmlTemplate('emails/contact_mail.html.twig')
                ->context([
                    'nom' => $contact->getNom(),
                    'prenom' => $contact->getPrenom(),
                    'mail' => $contact->getEmail(),
                    'objet' => $contact->getObjet(),
                    'message' => $contact->getMessage(),
                ]);

            // on envoie l'email
            $mailer->send($email);
            
            // on invoque le message flash de confirmation
            $this->addFlash('message', 'Votre e-mail a bien été envoyé');

            // on redirige vers la page elle-même
            return $this->redirectToRoute('app_accueil');
            
        }

        return $this->render('accueil/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
