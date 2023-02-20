<?php

namespace App\Controller;

use App\Entity\PreInscription;
use App\Form\PreInscriptionCursusType;
use App\Form\PreInscriptionJustifType;
use App\Form\PreInscriptionType;
use App\Repository\PreInscriptionRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function new(Request $request, PreInscriptionRepository $preInscriptionRepository): Response
    {
        $preInscription = new PreInscription();
        $form = $this->createForm(PreInscriptionType::class, $preInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $preInscriptionRepository->save($preInscription, true);

            return $this->redirectToRoute('app_pre_inscription_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pre_inscription/new.html.twig', [
            'pre_inscription' => $preInscription,
            'form' => $form,
        ]);
    }


    #[Route('/newFormCursus', name: 'app_new_form_Cursus', methods: ['GET', 'POST'])]
    public function newFormCursus(Request $request, PreInscriptionRepository $preInscriptionRepository): Response
    {
        $preInscription2 = new PreInscription();
        $form = $this->createForm(PreInscriptionCursusType::class, $preInscription2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $preInscriptionRepository->save($preInscription2, true);

            return $this->redirectToRoute('app_new_form_justif', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pre_inscription/new_formCursus.html.twig', [
            'pre_inscription2' => $preInscription2,
            'form' => $form,
        ]);
    }



    #[Route('/newFormJustif', name: 'app_new_form_justif', methods: ['GET', 'POST'])]
    public function newFormJustif(Request $request, PreInscriptionRepository $preInscriptionRepository,FileUploader $fileUploader): Response
    {
        $preInscription3 = new PreInscription();
        $form = $this->createForm(PreInscriptionJustifType::class, $preInscription3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $preInscriptionRepository->save($preInscription3, true);

            $carteIdentiteFile=$form->get('carteIdentite')->getData();
            if($carteIdentiteFile){
               $carteIdentiteFileName= $fileUploader->upload($carteIdentiteFile);
               $preInscription3->setCarteIdentite($carteIdentiteFileName);
            }

            $justifFinancementFile=$form->get('justifFinancement')->getData();
            if($justifFinancementFile){
               $justifFinancementFileName= $fileUploader->upload($justifFinancementFile);
               $preInscription3->setCarteIdentite($justifFinancementFileName);
            }

            $carteVitaleFile=$form->get('carteVitale')->getData();
            if($carteVitaleFile){
               $carteVitaleFileName= $fileUploader->upload($carteVitaleFile);
               $preInscription3->setCarteIdentite($carteVitaleFileName);
            }

            $autreDocFile=$form->get('autreDoc')->getData();
            if($autreDocFile){
               $autreDocFileName= $fileUploader->upload($autreDocFile);
               $preInscription3->setCarteIdentite($autreDocFileName);
            }

            return $this->redirectToRoute('app_espace_personnel_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pre_inscription/new_formJustif.html.twig', [
            'pre_inscription3' => $preInscription3,
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
    public function edit(Request $request, PreInscription $preInscription, PreInscriptionRepository $preInscriptionRepository): Response
    {
        $form = $this->createForm(PreInscriptionType::class, $preInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
