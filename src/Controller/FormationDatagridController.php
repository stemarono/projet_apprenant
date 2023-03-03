<?php

namespace App\Controller;

use App\Entity\Formation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formation/datagrid')]
class FormationDatagridController extends AbstractController
{
    #[Route('/data', name: 'app_formation_datagrid_data')]
    public function datagridData(EntityManagerInterface $em)
    {
        $formations = $em->getRepository(Formation::class)->findBy([], ['id' => 'desc']);
        $total = count($formations);
        $json_formations['total'] = $total;
        $json_formations['rows'] = [];
        foreach ($formations as $formation) {
            $json_formations['rows'][] = [
                'id' => $formation->getId(),
                'code' => $formation->getCode(),
                'titre' => $formation->getTitre(),
                'description' => $formation->getDescription()
            ];
        }
        return new JsonResponse($json_formations);
    }

    #[Route('/list', name: 'app_formation_datagrid_list')]
    public function datagridList() {
        return $this->render('datagrid/formations.html.twig');
    }
}
