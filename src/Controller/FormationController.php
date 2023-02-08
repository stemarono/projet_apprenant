<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/formation')]
class FormationController extends AbstractController
{
    #[Route('/', name: 'app_formation_index', methods: ['GET'])]
    public function index(FormationRepository $formationRepository): Response
    {
        return $this->render('formation/index.html.twig', [
            'formations' => $formationRepository->findAll(),
        ]);
    }

    #[Route('/list', name: 'app_formation_list', methods: ['GET'])]
    public function list(FormationRepository $formationRepository): Response
    {
        return $this->render('formation/list.html.twig', [
            'formations' => $formationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FormationRepository $formationRepository, FileUploader $fileUploader): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // gestion upload des images
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $photoFilename = md5(uniqid()) . '.' . $photoFile->guessExtension();
                $photoFile->move($this->getParameter('files_directory'), $photoFilename);
                $formation->setPhoto($photoFilename);
            }

            $formationRepository->save($formation, true);

            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_show', methods: ['GET'])]
    public function show(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formation $formation, FormationRepository $formationRepository): Response
    {

        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // gestion upload des images
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $photoFilename = md5(uniqid()) . '.' . $photoFile->guessExtension();
                $photoFile->move($this->getParameter('files_directory'), $photoFilename);
                $formation->setPhoto($photoFilename);
            }
            
            $formationRepository->save($formation, true);

            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_delete', methods: ['POST'])]
    public function delete(Request $request, Formation $formation, FormationRepository $formationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $formation->getId(), $request->request->get('_token'))) {
            $formationRepository->remove($formation, true);
        }

        return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
    }
}
