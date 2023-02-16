<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/menu')]
class MenuController extends AbstractController
{
    #[Route('/affichage', name: 'app_menu_affichage')]
    public function affichage(EntityManagerInterface $em){
        $menus=$em->getRepository(Menu::class)->findBy([],['rang'=>'asc']);
        $parent=null;
        $niveau=0;
        $html= $this->afficher_menu($em,$parent,$menus,$niveau);
        return $this->render("menu/affichage.html.twig",["html"=>$html]);
    }

    public function afficher_menu($em,$parent,$menus,$niveau){
        $html="";
        $niveau_precedent=0;
        if($niveau_precedent==$niveau && $niveau==0){
            $html.="<ul class='nav flex-center px-4 fs-5'>";
        }
        foreach($menus as $menu){
            $parent_menu=$menu->getParent();
            $libelle=$menu->getLibelle();
            $role=$menu->getRole();
            $role=($role)?$role->getLibelle():'ROLE_USER';
            $route=$menu->getRoute();
            $route=($route)?$route:'/';
            
            $drop=($niveau==0)?'dropdown':'dropend';
            $isGranted=$this->isGranted($role);
            if($parent_menu==$parent  && ($isGranted || $role=='ROLE_USER') ){
                if($niveau_precedent < $niveau){
                    $html.="<ul class='dropdown-menu bg-green'>";
                }
                $enfant=$em->getRepository(Menu::class)->findOneBy(['parent'=>$menu]);
                if($enfant){
                    $html.="<li class='nav-item $drop' >";
                    $html.="<a href='$route' class='nav-link dropdown-toggle text-clear' data-bs-toggle='dropdown' data-bs-auto-close='outside' >$libelle</a>";
                }else{
                    $html.="<li class='nav-item $drop'>";
                    $html.="<a href='$route' class='nav-link text-clear'>$libelle</a>";
                }
                $niveau_precedent=$niveau;
                $html.=$this->afficher_menu($em,$menu,$menus,$niveau+1);
            }
        }
        if($niveau_precedent==$niveau && $niveau!=0){
            $html.="</ul></li>";
        }elseif($niveau==0){
            $html.="</ul>";
        }else{
            $html.="</li>";
        }

        return $html;
    }
    
    #[Route('/', name: 'app_menu_index', methods: ['GET'])]
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('menu/index.html.twig', [
            'menus' => $menuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_menu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MenuRepository $menuRepository): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuRepository->save($menu, true);

            return $this->redirectToRoute('app_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/new.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_menu_show', methods: ['GET'])]
    public function show(Menu $menu): Response
    {
        return $this->render('menu/show.html.twig', [
            'menu' => $menu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Menu $menu, MenuRepository $menuRepository): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuRepository->save($menu, true);

            return $this->redirectToRoute('app_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/edit.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_menu_delete', methods: ['POST'])]
    public function delete(Request $request, Menu $menu, MenuRepository $menuRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menu->getId(), $request->request->get('_token'))) {
            $menuRepository->remove($menu, true);
        }

        return $this->redirectToRoute('app_menu_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/list', name: 'app_menu_list', methods: ['GET'])]
    public function list(MenuRepository $menuRepository): Response
    {
        return $this->render('menu/menu.html.twig', [
            'menus' => $menuRepository->findAll(),
        ]);
    }

}
