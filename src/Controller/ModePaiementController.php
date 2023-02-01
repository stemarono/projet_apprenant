<?php

namespace App\Controller;

use App\Entity\ModePaiement;
use App\Form\ModePaiementType;
use App\Repository\ModePaiementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mode/paiement')]
class ModePaiementController extends AbstractController
{
    #[Route('/new', name: 'app_mode_paiement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ModePaiementRepository $modePaiementRepository): Response
    {
        $modePaiement = new ModePaiement();
        $form = $this->createForm(ModePaiementType::class, $modePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modePaiementRepository->save($modePaiement, true);

            return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mode_paiement/new.html.twig', [
            'mode_paiement' => $modePaiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mode_paiement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ModePaiement $modePaiement, ModePaiementRepository $modePaiementRepository): Response
    {
        $form = $this->createForm(ModePaiementType::class, $modePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modePaiementRepository->save($modePaiement, true);

            return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mode_paiement/edit.html.twig', [
            'mode_paiement' => $modePaiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mode_paiement_delete', methods: ['POST'])]
    public function delete(Request $request, ModePaiement $modePaiement, ModePaiementRepository $modePaiementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modePaiement->getId(), $request->request->get('_token'))) {
            $modePaiementRepository->remove($modePaiement, true);
        }

        return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
    }
}
