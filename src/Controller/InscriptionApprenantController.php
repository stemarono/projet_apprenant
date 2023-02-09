<?php

namespace App\Controller;

use App\Entity\InscriptionApprenant;
use App\Form\InscriptionApprenantType;
use App\Repository\InscriptionApprenantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inscription/apprenant')]
class InscriptionApprenantController extends AbstractController
{
    #[Route('/', name: 'app_inscription_apprenant_index', methods: ['GET'])]
    public function index(InscriptionApprenantRepository $inscriptionApprenantRepository): Response
    {
        return $this->render('inscription_apprenant/index.html.twig', [
            'inscription_apprenants' => $inscriptionApprenantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_inscription_apprenant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InscriptionApprenantRepository $inscriptionApprenantRepository): Response
    {
        $inscriptionApprenant = new InscriptionApprenant();
        $form = $this->createForm(InscriptionApprenantType::class, $inscriptionApprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionApprenantRepository->save($inscriptionApprenant, true);

            return $this->redirectToRoute('app_inscription_apprenant_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscription_apprenant/new.html.twig', [
            'inscription_apprenant' => $inscriptionApprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscription_apprenant_show', methods: ['GET'])]
    public function show(InscriptionApprenant $inscriptionApprenant): Response
    {
        return $this->render('inscription_apprenant/show.html.twig', [
            'inscription_apprenant' => $inscriptionApprenant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inscription_apprenant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InscriptionApprenant $inscriptionApprenant, InscriptionApprenantRepository $inscriptionApprenantRepository): Response
    {
        $form = $this->createForm(InscriptionApprenantType::class, $inscriptionApprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionApprenantRepository->save($inscriptionApprenant, true);

            return $this->redirectToRoute('app_inscription_apprenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscription_apprenant/edit.html.twig', [
            'inscription_apprenant' => $inscriptionApprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscription_apprenant_delete', methods: ['POST'])]
    public function delete(Request $request, InscriptionApprenant $inscriptionApprenant, InscriptionApprenantRepository $inscriptionApprenantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscriptionApprenant->getId(), $request->request->get('_token'))) {
            $inscriptionApprenantRepository->remove($inscriptionApprenant, true);
        }

        return $this->redirectToRoute('app_inscription_apprenant_index', [], Response::HTTP_SEE_OTHER);
    }
}
