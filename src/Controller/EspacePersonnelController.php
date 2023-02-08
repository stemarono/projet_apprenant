<?php

namespace App\Controller;
use App\Controller\PreInscriptionController;
use App\Entity\PreInscription;
use Doctrine\ORM\EntityManagerInterface;
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


    #[Route('/espace/personnel/show/{id}', name: 'app_espace_personnel_show')]
    public function show(EntityManagerInterface $em,$id): Response
    {
       
        $espace=$em->getRepository(PreInscription::class)->findOneBy($id);


        return $this->render('espace_personnel/Espace_preinscription.html.twig', [
           'espace'=>$espace,
        ]);
    }


}
