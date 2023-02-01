<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Form\ParcoursType;
use App\Repository\ParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/parcours')]
class ParcoursController extends AbstractController
{
    #[Route('/new', name: 'app_parcours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ParcoursRepository $parcoursRepository): Response
    {
        $parcours = new Parcours();
        $form = $this->createForm(ParcoursType::class, $parcours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursRepository->save($parcours, true);

            return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours/new.html.twig', [
            'parcours' => $parcours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parcours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Parcours $parcours, ParcoursRepository $parcoursRepository): Response
    {
        $form = $this->createForm(ParcoursType::class, $parcours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursRepository->save($parcours, true);

            return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours/edit.html.twig', [
            'parcours' => $parcours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parcours_delete', methods: ['POST'])]
    public function delete(Request $request, Parcours $parcours, ParcoursRepository $parcoursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parcours->getId(), $request->request->get('_token'))) {
            $parcoursRepository->remove($parcours, true);
        }

        return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
    }
}
