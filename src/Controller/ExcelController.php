<?php

namespace App\Controller;

use App\Entity\InscriptionApprenant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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

    // fonction qui génère le fichier excel du tableau des inscrits
    #[Route('/inscription', name: 'app_inscription_excel', methods: ['GET'])]
    public function excelInscrit(EntityManagerInterface $em)
    {
        // ne génère pas les données de la table
        $spreadsheet=new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $inscriptions=$em->getRepository(InscriptionApprenant::class)->findAll();
        $row=1;
        $sheet->setCellValue("A$row","Identifiant");
        $sheet->setCellValue("B$row","Nom");
        $sheet->setCellValue("C$row","Prénom");
        $sheet->setCellValue("D$row","Date de naissance");
        $sheet->setCellValue("E$row","Sexe");
        $sheet->setCellValue("F$row","Adresse");
        $sheet->setCellValue("G$row","Code postal");
        $sheet->setCellValue("H$row","Ville");
        $sheet->setCellValue("I$row","Région");
        $sheet->setCellValue("J$row","Pays");
        $sheet->setCellValue("K$row","Téléphone");
        $sheet->setCellValue("L$row","E-mail");
        $sheet->setCellValue("M$row","Numéro de sécu");
        $sheet->setCellValue("N$row","Date d'inscription");
        $sheet->setCellValue("O$row","Montant");
        $sheet->setCellValue("P$row","Nombre d'échéances");        
        $row=2;
        foreach($inscriptions as $inscription){
            $identifiant = $inscription->getIdentifiant();
            $nom = $inscription->getNom();
            $prenom = $inscription->getPrenom();
            $dateNaissance = $inscription->getDateNaissance();
            $sexe = $inscription->getSexe();
            $adresse = $inscription->getAdresse();
            $codePostal = $inscription->getCodePostal();
            $ville = $inscription->getVille();
            $region = $inscription->getRegion();
            $pays = $inscription->getPays();
            $telephone = $inscription->getTelephone();
            $email = $inscription->getEmail();
            $numSecu = $inscription->getNumSecu();
            $dateInscription = $inscription->getDateInscription();
            $montant = $inscription->getMontant();
            $nbEcheance = $inscription->getNbEcheance();
            $sheet->setCellValue("A$row",$identifiant);
            $sheet->setCellValue("B$row",$nom);
            $sheet->setCellValue("C$row",$prenom);
            $sheet->setCellValue("D$row",$dateNaissance);
            $sheet->setCellValue("E$row",$sexe);
            $sheet->setCellValue("F$row",$adresse);
            $sheet->setCellValue("G$row",$codePostal);
            $sheet->setCellValue("H$row",$ville);
            $sheet->setCellValue("I$row",$region);
            $sheet->setCellValue("J$row",$pays);
            $sheet->setCellValue("K$row",$telephone);
            $sheet->setCellValue("L$row",$email);
            $sheet->setCellValue("M$row",$numSecu);
            $sheet->setCellValue("N$row",$dateInscription);
            $sheet->setCellValue("O$row",$montant);
            $sheet->setCellValue("P$row",$nbEcheance);
            $row++;
           
        }
        $sheet->setTitle('Inscription');
        $writer=new Xlsx($spreadsheet);
        $uniqueid=uniqid();
        $filename="Export_Inscription_$uniqueid.xlsx";
        $temp_file=tempnam(sys_get_temp_dir(),$filename);
        $writer->save($temp_file);
        return $this->file($temp_file,$filename,ResponseHeaderBag::DISPOSITION_INLINE);
    }
}
