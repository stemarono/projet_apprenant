<?php

namespace App\Controller;

use App\Entity\GroupeCursus;
use App\Form\GroupeCursusType;
use App\Repository\GroupeCursusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/groupe/cursus')]
class GroupeCursusController extends AbstractController
{
    #[Route('/new', name: 'app_groupe_cursus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GroupeCursusRepository $groupeCursusRepository): Response
    {
        $groupeCursus = new GroupeCursus();
        $form = $this->createForm(GroupeCursusType::class, $groupeCursus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupeCursusRepository->save($groupeCursus, true);

            return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('groupe_cursus/new.html.twig', [
            'groupe_cursus' => $groupeCursus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_groupe_cursus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GroupeCursus $groupeCursus, GroupeCursusRepository $groupeCursusRepository): Response
    {
        $form = $this->createForm(GroupeCursusType::class, $groupeCursus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupeCursusRepository->save($groupeCursus, true);

            return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('groupe_cursus/edit.html.twig', [
            'groupe_cursus' => $groupeCursus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_groupe_cursus_delete', methods: ['POST'])]
    public function delete(Request $request, GroupeCursus $groupeCursu, GroupeCursusRepository $groupeCursusRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupeCursu->getId(), $request->request->get('_token'))) {
            $groupeCursusRepository->remove($groupeCursu, true);
        }

        return $this->redirectToRoute('app_management_tools', [], Response::HTTP_SEE_OTHER);
    }
}
