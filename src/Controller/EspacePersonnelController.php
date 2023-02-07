<?php

namespace App\Controller;
use App\Controller\PreInscriptionController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspacePersonnelController extends AbstractController
{
    #[Route('/espace/personnel', name: 'app_espace_personnel')]
    public function index(): Response
    {
        return $this->render('espace_personnel/index.html.twig', [
            'controller_name' => 'EspacePersonnelController',
        ]);
    }


    #[Route('/espace/personnel/show', name: 'app_espace_personnel_show')]
    public function show(): Response
    {
        return $this->render('espace_personnel/Espace_preinscription.html.twig', [
           
        ]);
    }


}
