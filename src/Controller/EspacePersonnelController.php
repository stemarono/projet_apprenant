<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
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
        $user=$em->getRepository(User::class)->find($id);
       if(!$user)
       {
            $this->addFlash(type:"error", message:"cet utilisateur n'existe pas");
            return $this->redirectToRoute('app_espace_personnel_show');
       }
        return $this->render('espace_personnel/Espace_preinscription.html.twig', [
           'user'=>$user,
        ]);
    }


}
