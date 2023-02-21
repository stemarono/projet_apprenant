<?php

namespace App\Controller;

use App\Entity\PreInscription;
use App\Entity\User;
use App\Form\PreInscriptionType;
use App\Repository\PreInscriptionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EspacePersonnelController extends AbstractController
{
    #[Route('/espace/personnel', name: 'app_espace_personnel')]
    public function index(UserRepository $userRepository): Response
    {
      
        return $this->render('espace_personnel/index.html.twig', [
        
          'users'=>$userRepository->findAll(),
        ]);
    }


    #[Route('/espace/personnel/show/{id}', name: 'app_espace_personnel_show')]
    public function show(EntityManagerInterface $em, $id=0): Response
    {
        $user = new User;
        $user=$em->getRepository(User::class)->find($id);
    //    if(!$user)
    //    {
    //         $this->addFlash(type:"error", message:"cet utilisateur n'existe pas");
    //         return $this->redirectToRoute('app_espace_personnel_show');
    //    }
        return $this->render('espace_personnel/Espace_preinscription.html.twig', [
           'user'=>$user,
        ]);
    }

    #[Route('/espace/personnel/showFolder', name: 'app_espace_personnel_showFolder')]
    public function showFolder(EntityManagerInterface $em): Response
    {
        $user=$this->getUser();
           $preInscription= $em->getRepository(PreInscription::class)->findOneBy(['user'=>$user]);
      
        return $this->render('pre_inscription/show.html.twig', [
           'user'=>$user,
           'pre_inscription'=>$preInscription,
        ]);
    }

    #[Route('/espace/personnel/editFolder', name: 'app_espace_personnel_editFolder')]
    public function editFolder(EntityManagerInterface $em,Request $request,PreInscription $preInscription=null): Response
    {
        $user=$this->getUser();
        $preInscription= $em->getRepository(PreInscription::class)->findOneBy(['user'=>$user]);
        
        $form=$this->createForm(PreInscriptionType::class,$preInscription);
        $form->handleRequest($request);
        
       if($form->isSubmitted() && $form->isValid())
       {
        
        $em->persist($preInscription);
        $em->flush();
       
        return $this->redirectToRoute('app_espace_personnel_show');
       }

      
        return $this->renderForm('pre_inscription/edit.html.twig', [
          
          'pre_inscription'=>$preInscription,
          'form'=>$form,
        ]);
    }


    // #[Route('/espace/personnel/delete/{id}', name: 'app_espace_personnel_delete', methods: ['POST'])]
    // public function delete(Request $request, PreInscription $preInscription, PreInscriptionRepository $preInscriptionRepository): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$preInscription->getId(), $request->request->get('_token'))) {
    //         $preInscriptionRepository->remove($preInscription, true);
    //     }

    //     return $this->redirectToRoute('app_espace_personnel', [], Response::HTTP_SEE_OTHER);
    // }


    #[Route('/espace/personnel/deleteFolder', name: 'app_espace_personnel_deleteFolder')]
    public function deleteFolder(EntityManagerInterface $em,Request $request,PreInscriptionRepository $preInscriptionRepository): Response
    {
        $user=$this->getUser();
        $preInscription= $em->getRepository(PreInscription::class)->findOneBy(['user'=>$user]);
      
        if($preInscription)
         {
            $em->remove($preInscription);
             $em->flush();  
             return $this->redirectToRoute('app_espace_personnel');
         }
         return $this->renderForm('pre_inscription/_delete_form.html.twig');
        
    }


}
