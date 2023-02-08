<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    public function base(FormationRepository $formationRepository): Response
    {
        return $this->render('base.html.twig', [
            'formations' => $formationRepository->findAll(),
        ]);
    }
}
