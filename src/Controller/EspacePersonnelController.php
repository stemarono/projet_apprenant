<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EspacePersonnelController extends AbstractController
{
    #[Route('/espace/personnel', name: 'app_espace_personnel')]
    public function index(Request $request,EntityManagerInterface $em,$id=0): Response
    {
        // $user=$em->getRepository(User::class)->find($id);

        // $form=$this->createForm(UserType::class,$user);
        // $form->handleRequest($request);
        // if($form->isSubmitted() && $form->isValid())
        // {
        //     $em->persist($user);
        //     $em->flush();
        //     return $this->redirectToRoute('app_espace_personnel');
        // }
        
        return $this->render('espace_personnel/index.html.twig', [
        //     'form'=>$form->createView(),
        //    'user'=>$user,
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
