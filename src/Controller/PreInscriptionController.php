<?php

namespace App\Controller;

use App\Entity\PreInscription;
use App\Form\PreInscriptionType;
use App\Repository\PreInscriptionRepository;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/pre/inscription')]
class PreInscriptionController extends AbstractController
{
    #[Route('/', name: 'app_pre_inscription_index', methods: ['GET'])]
    public function index(PreInscriptionRepository $preInscriptionRepository): Response
    {
        return $this->render('pre_inscription/index.html.twig', [
            'pre_inscriptions' => $preInscriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pre_inscription_new', methods: ['GET', 'POST'])]
<<<<<<< HEAD
    public function new(Request $request, PreInscriptionRepository $preInscriptionRepository, SluggerInterface $slugger, FileUploader $fileUploader): Response
=======
    public function new(Request $request, PreInscriptionRepository $preInscriptionRepository,FileUploader $fileUploader, SluggerInterface $slugger): Response
>>>>>>> bc9231f0f22dd06727670f04af2efbb07487462d
    {
        $preInscription = new PreInscription();
        $form = $this->createForm(PreInscriptionType::class, $preInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
<<<<<<< HEAD

            /** @var UploadedFile $carteIdentiteContenu */
            $carteIdentiteContenu = $form->get('carteIdentite')->getData();
            if ($carteIdentiteContenu) {
                $carteIdentiteNomOriginal = pathinfo($carteIdentiteContenu->getClientOriginalName(), PATHINFO_FILENAME);
                $carteIdentiteNomSur = $slugger->slug($carteIdentiteNomOriginal);
                $carteIdentiteNomNouveau = $carteIdentiteNomSur.'-'.uniqid().'.'.$carteIdentiteContenu->guessExtension();
                try {
                    $carteIdentiteContenu->move(
                        $this->getParameter('files_directory'),
                        $carteIdentiteNomNouveau
                    );
                } catch (FileException $e) {
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setCarteIdentiteNom($carteIdentiteNomNouveau);
            }

            /** @var UploadedFile $justifFinancementContenu */
            $justifFinancementContenu = $form->get('justifFinancement')->getData();
            if ($justifFinancementContenu) {
                $justifFinancementNomOriginal = pathinfo($justifFinancementContenu->getClientOriginalName(), PATHINFO_FILENAME);
                $justifFinancementNomSur = $slugger->slug($justifFinancementNomOriginal);
                $justifFinancementNomNouveau = $justifFinancementNomSur.'-'.uniqid().'.'.$justifFinancementContenu->guessExtension();
                try {
                    $justifFinancementContenu->move(
                        $this->getParameter('files_directory'),
                        $justifFinancementNomNouveau
                    );
                } catch (FileException $e) {
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setJustifFinancementNom($justifFinancementNomNouveau);
            }

            /** @var UploadedFile $carteVitaleContenu */
            $carteVitaleContenu = $form->get('carteVitale')->getData();
            if ($carteVitaleContenu) {
                $carteVitaleNomOriginal = pathinfo($carteVitaleContenu->getClientOriginalName(), PATHINFO_FILENAME);
                $carteVitaleNomSur = $slugger->slug($carteVitaleNomOriginal);
                $carteVitaleNomNouveau = $carteVitaleNomSur.'-'.uniqid().'.'.$carteVitaleContenu->guessExtension();
                try {
                    $carteVitaleContenu->move(
                        $this->getParameter('files_directory'),
                        $carteVitaleNomNouveau
                    );
                } catch (FileException $e) {
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setCarteVitaleNom($carteVitaleNomNouveau);
            }

            /** @var UploadedFile $autreDocContenu */
            $autreDocContenu = $form->get('autreDoc')->getData();
            if ($autreDocContenu) {
                $autreDocNomOriginal = pathinfo($autreDocContenu->getClientOriginalName(), PATHINFO_FILENAME);
                $autreDocNomSur = $slugger->slug($autreDocNomOriginal);
                $autreDocNomNouveau = $autreDocNomSur.'-'.uniqid().'.'.$autreDocContenu->guessExtension();
                try {
                    $autreDocContenu->move(
                        $this->getParameter('files_directory'),
                        $autreDocNomNouveau
                    );
                } catch (FileException $e) {
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setAutreDocNom($autreDocNomNouveau);
            }

            $this->addFlash('message', 'Votre formulaire a bien été envoyé');
       
=======
            /** @var UploadedFile $carteIdentiteFile */
            $carteIdentiteFile=$form->get('carteIdentite')->getData();
            if($carteIdentiteFile)
            {
                $fichierOriginal=pathinfo($carteIdentiteFile->getClientOriginalName(),PATHINFO_FILENAME);
                $fichierSauvegarde=$slugger->slug($fichierOriginal);
                $nouveaufichier=$fichierSauvegarde.'.'.$carteIdentiteFile->guessExtension();

                try{
                    $carteIdentiteFile->move(
                        $this->getParameter('files_directory'),
                        $nouveaufichier
                    );

                }catch(FileException $e){
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setCarteIdentite($nouveaufichier);
            }

            
            $justifFile=$form->get('justifFinancement')->getData();
            if($justifFile)
            {
                $fichierOriginal=pathinfo($justifFile->getClientOriginalName(),PATHINFO_FILENAME);
                $fichierSauvegarde=$slugger->slug($fichierOriginal);
                $newFile=$fichierSauvegarde.'.'.$justifFile->guessExtension();

                try{
                    $justifFile->move(
                        $this->getParameter('files_directory'),
                        $newFile
                    );

                }catch(FileException $e){
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setJustifFinancement($newFile);
            }
          
            $carteVitaleFile=$form->get('carteVitale')->getData();
            if($carteVitaleFile)
            {
                $fichierOriginal=pathinfo($carteVitaleFile->getClientOriginalName(),PATHINFO_FILENAME);
                $fichierSauvegarde=$slugger->slug($fichierOriginal);
                $fichierNouveau=$fichierSauvegarde.'.'.$carteVitaleFile->guessExtension();

                try{
                    $justifFile->move(
                        $this->getParameter('files_directory'),
                        $fichierNouveau
                    );

                }catch(FileException $e){
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setCarteVitale($fichierNouveau);
            }

            $autreDocFile=$form->get('autreDoc')->getData();
            if($autreDocFile)
            {
                $fichierOriginal=pathinfo($autreDocFile->getClientOriginalName(),PATHINFO_FILENAME);
                $fichierSauvegarde=$slugger->slug($fichierOriginal);
                $fileNew=$fichierSauvegarde.'.'.$autreDocFile->guessExtension();

                try{
                    $justifFile->move(
                        $this->getParameter('files_directory'),
                        $fileNew
                    );

                }catch(FileException $e){
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setAutreDoc($fileNew);
            }

           
>>>>>>> bc9231f0f22dd06727670f04af2efbb07487462d
            $preInscriptionRepository->save($preInscription, true);
            return $this->redirectToRoute('app_espace_personnel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pre_inscription/new.html.twig', [
            'pre_inscription' => $preInscription,
            'form' => $form,
        ]);
    }

<<<<<<< HEAD
=======
   
  

>>>>>>> bc9231f0f22dd06727670f04af2efbb07487462d
    #[Route('/{id}', name: 'app_espace_preInscription', methods: ['GET'])]
    public function Espace_preInscription (EntityManagerInterface $em,$id): Response
    {
        // le template n'existe pas
        $preInscription=$em->getRepository(PreInscription::class)->find($id);
        return $this->render('pre_inscription/espace_preinscription.html.twig', [
            'preInscription' => $preInscription,
        ]);
    }

    #[Route('/show/{id}', name: 'app_pre_inscription_show', methods: ['GET'])]
    public function show(PreInscription $preInscription): Response
    {
        return $this->render('pre_inscription/show.html.twig', [
            'pre_inscription' => $preInscription,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_pre_inscription_edit', methods: ['GET', 'POST'])]
<<<<<<< HEAD
    public function edit(Request $request, PreInscription $preInscription, SluggerInterface $slugger, PreInscriptionRepository $preInscriptionRepository,FileUploader $fileUploader): Response
=======
    public function edit(Request $request, PreInscription $preInscription, PreInscriptionRepository $preInscriptionRepository,FileUploader $fileUploader,SluggerInterface $slugger): Response
>>>>>>> bc9231f0f22dd06727670f04af2efbb07487462d
    {
        $form = $this->createForm(PreInscriptionType::class, $preInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
<<<<<<< HEAD
            
            /** @var UploadedFile $carteIdentiteContenu */
            $carteIdentiteContenu = $form->get('carteIdentite')->getData();
            if ($carteIdentiteContenu) {
                $carteIdentiteNomOriginal = pathinfo($carteIdentiteContenu->getClientOriginalName(), PATHINFO_FILENAME);
                $carteIdentiteNomSur = $slugger->slug($carteIdentiteNomOriginal);
                $carteIdentiteNomNouveau = $carteIdentiteNomSur.'-'.uniqid().'.'.$carteIdentiteContenu->guessExtension();
                try {
                    $carteIdentiteContenu->move(
                        $this->getParameter('files_directory'),
                        $carteIdentiteNomNouveau
                    );
                } catch (FileException $e) {
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setCarteIdentiteNom($carteIdentiteNomNouveau);
            }

            /** @var UploadedFile $justifFinancementContenu */
            $justifFinancementContenu = $form->get('justifFinancement')->getData();
            if ($justifFinancementContenu) {
                $justifFinancementNomOriginal = pathinfo($justifFinancementContenu->getClientOriginalName(), PATHINFO_FILENAME);
                $justifFinancementNomSur = $slugger->slug($justifFinancementNomOriginal);
                $justifFinancementNomNouveau = $justifFinancementNomSur.'-'.uniqid().'.'.$justifFinancementContenu->guessExtension();
                try {
                    $justifFinancementContenu->move(
                        $this->getParameter('files_directory'),
                        $justifFinancementNomNouveau
                    );
                } catch (FileException $e) {
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setJustifFinancementNom($justifFinancementNomNouveau);
            }

            /** @var UploadedFile $carteVitaleContenu */
            $carteVitaleContenu = $form->get('carteVitale')->getData();
            if ($carteVitaleContenu) {
                $carteVitaleNomOriginal = pathinfo($carteVitaleContenu->getClientOriginalName(), PATHINFO_FILENAME);
                $carteVitaleNomSur = $slugger->slug($carteVitaleNomOriginal);
                $carteVitaleNomNouveau = $carteVitaleNomSur.'-'.uniqid().'.'.$carteVitaleContenu->guessExtension();
                try {
                    $carteVitaleContenu->move(
                        $this->getParameter('files_directory'),
                        $carteVitaleNomNouveau
                    );
                } catch (FileException $e) {
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setCarteVitaleNom($carteVitaleNomNouveau);
            }

            /** @var UploadedFile $autreDocContenu */
            $autreDocContenu = $form->get('autreDoc')->getData();
            if ($autreDocContenu) {
                $autreDocNomOriginal = pathinfo($autreDocContenu->getClientOriginalName(), PATHINFO_FILENAME);
                $autreDocNomSur = $slugger->slug($autreDocNomOriginal);
                $autreDocNomNouveau = $autreDocNomSur.'-'.uniqid().'.'.$autreDocContenu->guessExtension();
                try {
                    $autreDocContenu->move(
                        $this->getParameter('files_directory'),
                        $autreDocNomNouveau
                    );
                } catch (FileException $e) {
                    $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                }
                $preInscription->setAutreDocNom($autreDocNomNouveau);
            }

            $this->addFlash('message', 'Votre formulaire a bien été envoyé');
       
=======
             /** @var UploadedFile $carteIdentiteFile */
             $carteIdentiteFile=$form->get('carteIdentite')->getData();
             if($carteIdentiteFile)
             {
                 $fichierOriginal=pathinfo($carteIdentiteFile->getClientOriginalName(),PATHINFO_FILENAME);
                 $fichierSauvegarde=$slugger->slug($fichierOriginal);
                 $nouveaufichier=$fichierSauvegarde.'.'.$carteIdentiteFile->guessExtension();
 
                 try{
                     $carteIdentiteFile->move(
                         $this->getParameter('files_directory'),
                         $nouveaufichier
                     );
 
                 }catch(FileException $e){
                     $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                 }
                 $preInscription->setCarteIdentite($nouveaufichier);
             }
 
             
             $justifFile=$form->get('justifFinancement')->getData();
             if($justifFile)
             {
                 $fichierOriginal=pathinfo($justifFile->getClientOriginalName(),PATHINFO_FILENAME);
                 $fichierSauvegarde=$slugger->slug($fichierOriginal);
                 $nouveaufichier=$fichierSauvegarde.'.'.$justifFile->guessExtension();
 
                 try{
                     $justifFile->move(
                         $this->getParameter('files_directory'),
                         $nouveaufichier
                     );
 
                 }catch(FileException $e){
                     $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                 }
                 $preInscription->setJustifFinancement($nouveaufichier);
             }
           
             $carteVitaleFile=$form->get('carteVitale')->getData();
             if($carteVitaleFile)
             {
                 $fichierOriginal=pathinfo($carteVitaleFile->getClientOriginalName(),PATHINFO_FILENAME);
                 $fichierSauvegarde=$slugger->slug($fichierOriginal);
                 $nouveaufichier=$fichierSauvegarde.'.'.$carteVitaleFile->guessExtension();
 
                 try{
                     $justifFile->move(
                         $this->getParameter('files_directory'),
                         $nouveaufichier
                     );
 
                 }catch(FileException $e){
                     $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                 }
                 $preInscription->setCarteVitale($nouveaufichier);
             }
 
             $autreDocFile=$form->get('autreDoc')->getData();
             if($autreDocFile)
             {
                 $fichierOriginal=pathinfo($autreDocFile->getClientOriginalName(),PATHINFO_FILENAME);
                 $fichierSauvegarde=$slugger->slug($fichierOriginal);
                 $nouveaufichier=$fichierSauvegarde.'.'.$autreDocFile->guessExtension();
 
                 try{
                     $justifFile->move(
                         $this->getParameter('files_directory'),
                         $nouveaufichier
                     );
 
                 }catch(FileException $e){
                     $this->addFlash('message', 'Une erreur s\'est produite lors du téléchargement de votre fichier');
                 }
                 $preInscription->setAutreDoc($nouveaufichier);
             }
>>>>>>> bc9231f0f22dd06727670f04af2efbb07487462d
            $preInscriptionRepository->save($preInscription, true);
            return $this->redirectToRoute('app_pre_inscription_new', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('pre_inscription/edit.html.twig', [
            'pre_inscription' => $preInscription,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_pre_inscription_delete', methods: ['POST'])]
    public function delete(Request $request, PreInscription $preInscription, PreInscriptionRepository $preInscriptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$preInscription->getId(), $request->request->get('_token'))) {
            $preInscriptionRepository->remove($preInscription, true);
        }

        return $this->redirectToRoute('app_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
    }
}
