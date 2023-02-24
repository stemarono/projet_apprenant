<?php

namespace App\Controller;

use App\Entity\InscriptionApprenant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/excel')]
class ExcelController extends AbstractController
{
    // fonction qui liste les fichiers excel disponibles
    #[Route('/', name: 'app_excel')]
    public function index(): Response
    {
        return $this->render('excel/index.html.twig');
    }

    // fonction qui génère le pdf du tableau des inscrits
    #[Route('/inscription', name: 'app_inscription_excel', methods: ['GET'])]
    public function excelInscrit(EntityManagerInterface $em)
    {
        $inscriptions = $em->getRepository(InscriptionApprenant::class)->findAll();
        
        // trouver le code pour convertir le fichier excel/inscriptions_excel.html.twig
        // en inscriptions.xls

        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');
        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');

        return $this->renderView('excel/inscriptions_excel.html.twig', [
            'writer' => $writer,
            'inscriptions' => $inscriptions
        ]);
    }
}
