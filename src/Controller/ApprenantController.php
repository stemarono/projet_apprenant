<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Form\ApprenantType;
use App\Repository\ApprenantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/apprenant')]
class ApprenantController extends AbstractController
{
    #[Route('/', name: 'app_apprenant_index', methods: ['GET'])]
    public function index(ApprenantRepository $apprenantRepository): Response
    {
        return $this->render('apprenant/index.html.twig', [
            'apprenants' => $apprenantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_apprenant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ApprenantRepository $apprenantRepository): Response
    {
        $apprenant = new Apprenant();
        $form = $this->createForm(ApprenantType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $apprenantRepository->save($apprenant, true);

            return $this->redirectToRoute('app_apprenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('apprenant/new.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_apprenant_show', methods: ['GET'])]
    public function show(Apprenant $apprenant): Response
    {
        return $this->render('apprenant/show.html.twig', [
            'apprenant' => $apprenant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_apprenant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Apprenant $apprenant, ApprenantRepository $apprenantRepository): Response
    {
        $form = $this->createForm(ApprenantType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $apprenantRepository->save($apprenant, true);

            return $this->redirectToRoute('app_apprenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('apprenant/edit.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_apprenant_delete', methods: ['POST'])]
    public function delete(Request $request, Apprenant $apprenant, ApprenantRepository $apprenantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apprenant->getId(), $request->request->get('_token'))) {
            $apprenantRepository->remove($apprenant, true);
        }

        return $this->redirectToRoute('app_apprenant_index', [], Response::HTTP_SEE_OTHER);
    }
}
