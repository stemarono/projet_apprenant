<?php

namespace App\Controller;

use App\Entity\InscriptionApprenant;
use App\Form\InscriptionApprenantType;
use App\Repository\InscriptionApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inscription/apprenant')]
class InscriptionApprenantController extends AbstractController
{
    #[Route('/datagrid/list',name:'app_inscription_apprenant_datagrid_list')]
    public function datagridList()
    {
        return $this->render('inscription_apprenant/datagridList.html.twig');
    }

    #[Route('/datagrid/data',name:"app_inscription_apprenant_datagrid_data")]
    public function datagridData(EntityManagerInterface $em)
    {
        $inscriptionApprenants=$em->getRepository(InscriptionApprenant::class)->findBy([],['id'=>'asc']);
        $json_inscriptionApprenants['rows']=[];
        foreach($inscriptionApprenants as $inscriptionApprenant)
        {
            $json_inscriptionApprenants['rows'][]=[
                'id'=>$inscriptionApprenant->getId(),
                'identifiant'=>$inscriptionApprenant->getIdentifiant(),
                'nom'=>$inscriptionApprenant->getNom(),
                'prenom'=>$inscriptionApprenant->getPrenom(),
                'dateNaissance'=>$inscriptionApprenant->getDateNaissance()->format('d/m/Y'),
                'telephone'=>$inscriptionApprenant->getTelephone(),
                'email'=>$inscriptionApprenant->getEmail(),
            ];
        }
        return new JsonResponse($json_inscriptionApprenants);
    }


    #[Route('/', name: 'app_inscription_apprenant_index', methods: ['GET'])]
    public function index(InscriptionApprenantRepository $inscriptionApprenantRepository): Response
    {
        return $this->render('inscription_apprenant/index.html.twig', [
            'inscription_apprenants' => $inscriptionApprenantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_inscription_apprenant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InscriptionApprenantRepository $inscriptionApprenantRepository): Response
    {
        $inscriptionApprenant = new InscriptionApprenant();
        $form = $this->createForm(InscriptionApprenantType::class, $inscriptionApprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionApprenantRepository->save($inscriptionApprenant, true);

            return $this->redirectToRoute('app_inscription_apprenant_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscription_apprenant/new.html.twig', [
            'inscription_apprenant' => $inscriptionApprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscription_apprenant_show', methods: ['GET'])]
    public function show(InscriptionApprenant $inscriptionApprenant): Response
    {
        return $this->render('inscription_apprenant/show.html.twig', [
            'inscription_apprenant' => $inscriptionApprenant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inscription_apprenant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InscriptionApprenant $inscriptionApprenant, InscriptionApprenantRepository $inscriptionApprenantRepository): Response
    {
        $form = $this->createForm(InscriptionApprenantType::class, $inscriptionApprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionApprenantRepository->save($inscriptionApprenant, true);

            return $this->redirectToRoute('app_inscription_apprenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscription_apprenant/edit.html.twig', [
            'inscription_apprenant' => $inscriptionApprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscription_apprenant_delete', methods: ['POST'])]
    public function delete(Request $request, InscriptionApprenant $inscriptionApprenant, InscriptionApprenantRepository $inscriptionApprenantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscriptionApprenant->getId(), $request->request->get('_token'))) {
            $inscriptionApprenantRepository->remove($inscriptionApprenant, true);
        }

        return $this->redirectToRoute('app_inscription_apprenant_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/data', name: 'app_product_data')]
    public function data(EntityManagerInterface $em,Request $request)
    {
        $mot=$request->get('mot');//$mot =$_POST['mot'] on peut mettre $mot=$_POST['mot'] mais cela n'est pas aussi sécurisé que le $request->get('mot')
        $mot=($mot=='')?'0':$mot;
        $products=$em->getRepository(InscriptionApprenant::class)->findMot($mot);
        
        // la partie en dessous apparaît maintenant dans listPorduct.html.twig

        //var_dump($products);die;
        //json n'aime les objets, il veut un tableau donc on va créer un tableau
        // $data=[];
        // foreach($products as $product)
        // {
        //    $data[]=[
        //     'id'=>$product->getId(),
        //     'code'=>$product->getCode(),
        //     'designation'=>$product->getDesignation(),
        //     'pu'=>$product->getPrixUnitaire(),
        //     'pr'=>$product->getPrixUnitaire()/2,
        //    ];
        // }
        return new JsonResponse($products);
          
           
    }

}
