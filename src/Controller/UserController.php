<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Role;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository,EntityManagerInterface $em,UserPasswordHasherInterface $passwordHasher,$id=0): Response
    {
       if($id)
       {
        $user=$em->getRepository(User::class)->find($id);
       }else{
        $user =new User;
       }
       
        $roles=$em->getRepository(Role::class)->findBy([],['code_role'=>'asc']);
        $choice_roles=[];
        foreach($roles as $role)
        {
            $libelle=$role->getLibelle();
            $choice_roles[$libelle]=$libelle;
           
            
        }
        
        $form = $this->createForm(UserType::class, $user);
        // $form
            // ->add('Roles',ChoiceType::class,[
            //     'mapped'=>false,
            //     'choices'=>$choice_roles,
            //     'multiple'=>true,
            //     'label'=>'Roles :',
            //     'attr'=>['class'=>'form-control']
             
            // ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roles=$form->get('roles')->getData();
            $user->setRoles($roles);
            $passwd=$form->get('password')->getData();
            if($passwd){
                $password =$passwordHasher->hashPassword($user,$passwd);
                $user->setPassword($password);
            }
            $userRepository->save($user, true);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/editFolder', name: 'app_user_editFolder', methods: ['GET', 'POST'])]
    public function editFolder(Request $request, User $user, UserRepository $userRepository,EntityManagerInterface $em,UserPasswordHasherInterface $passwordHasher,$id=0): Response
    {
       if($id)
       {
        $user=$em->getRepository(User::class)->find($id);
       }else{
        $user =new User;
       }
       
               
        $form = $this->createForm(UserType::class, $user);   
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $passwd=$form->get('password')->getData();
            if($passwd){
                $password =$passwordHasher->hashPassword($user,$passwd);
                $user->setPassword($password);
            }
            $userRepository->save($user, true);
            return $this->redirectToRoute('app_espace_personnel_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/editFolder.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

   
    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
