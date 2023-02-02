<?php

namespace App\Controller;

use App\Repository\CursusRepository;
use App\Repository\FinancementRepository;
use App\Repository\GroupeCursusRepository;
use App\Repository\ModePaiementRepository;
use App\Repository\ParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/management')]
class ManagementController extends AbstractController
{
    #[Route('/tools', name: 'app_management_tools', methods: ['GET'])]
    public function index(CursusRepository $cursusRepository, 
                            GroupeCursusRepository $groupeCursusRepository, 
                            ParcoursRepository $parcoursRepository,
                            FinancementRepository $financementRepository,
                            ModePaiementRepository $modePaiementRepository): Response
    {
        return $this->render('management/index.html.twig', [
            'cursuss' => $cursusRepository->findAll(),
            'groupe_cursuss' => $groupeCursusRepository->findAll(),
            'parcourss' => $parcoursRepository->findAll(),
            'financements' => $financementRepository->findAll(),
            'mode_paiements' => $modePaiementRepository->findAll(),
        ]);
    }
}