<?php

namespace App\Controller;

use App\Entity\PreInscription;
use App\Form\PreInscriptionType;
use App\Repository\PreInscriptionRepository;
use App\Service\FileUploader;
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
    public function new(Request $request, PreInscriptionRepository $preInscriptionRepository,FileUploader $fileUploader, SluggerInterface $slugger): Response
    {
        $preInscription = new PreInscription();
        $form = $this->createForm(PreInscriptionType::class, $preInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

           
            $preInscriptionRepository->save($preInscription, true);
            return $this->redirectToRoute('app_espace_personnel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pre_inscription/new.html.twig', [
            'pre_inscription' => $preInscription,
            'form' => $form,
        ]);
    }

   
  

    #[Route('/{id}', name: 'app_espace_preInscription', methods: ['GET'])]
    public function Espace_preInscription (EntityManagerInterface $em,$id): Response
    {
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
    public function edit(Request $request, PreInscription $preInscription, PreInscriptionRepository $preInscriptionRepository,FileUploader $fileUploader,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PreInscriptionType::class, $preInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
            $preInscriptionRepository->save($preInscription, true);

            return $this->redirectToRoute('app_pre_inscription_index', [], Response::HTTP_SEE_OTHER);
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
