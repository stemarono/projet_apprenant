<?php

namespace App\Controller;

use App\Entity\Financement;
use App\Form\FinancementType;
use App\Repository\FinancementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/financement')]
class FinancementController extends AbstractController
{
    #[Route('/new', name: 'app_financement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FinancementRepository $financementRepository): Response
    {
        $financement = new Financement();
        $form = $this->createForm(FinancementType::class, $financement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $financementRepository->save($financement, true);

            return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('financement/new.html.twig', [
            'financement' => $financement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_financement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Financement $financement, FinancementRepository $financementRepository): Response
    {
        $form = $this->createForm(FinancementType::class, $financement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $financementRepository->save($financement, true);

            return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('financement/edit.html.twig', [
            'financement' => $financement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_financement_delete', methods: ['POST'])]
    public function delete(Request $request, Financement $financement, FinancementRepository $financementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$financement->getId(), $request->request->get('_token'))) {
            $financementRepository->remove($financement, true);
        }

        return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
    }
}
