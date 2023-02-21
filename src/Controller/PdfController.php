<?php

namespace App\Controller;

use App\Entity\InscriptionApprenant;
use App\Entity\PreInscription;
use Doctrine\ORM\EntityManagerInterface;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pdf')]
class PdfController extends AbstractController
{
    // fonction qui liste les pdf disponibles
    #[Route('/', name: 'app_pdf')]
    public function index(): Response
    {
        return $this->render('pdf/index.html.twig');
    }

    // fonction qui génère le pdf du tableau des inscrits
    #[Route('/inscription', name: 'app_inscription_pdf', methods: ['GET'])]
    public function pdfListInscrit(EntityManagerInterface $em)
    {
        $inscriptions = $em->getRepository(InscriptionApprenant::class)->findAll();
        $html = $this->renderView('pdf/inscription_liste_pdf.html.twig', [
            'inscriptions' => $inscriptions
        ]);
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $fichier = 'liste_inscrits.pdf';
        $html2pdf->writeHTML($html);
        $html2pdf->output($fichier, 'D');
    }

    // fonction qui génère le pdf du dossier inscrit
    #[Route('/inscription/{id}', name: 'app_inscription_apprenant_pdf', methods: ['GET'])]
    public function pdfInscrit(EntityManagerInterface $em, $id)
    {
       $inscription = $em->getRepository(InscriptionApprenant::class)->find($id);

       $html = $this->renderView('pdf/inscription_apprenant_pdf.html.twig', [
        'inscription_apprenant' => $inscription
       ]);
       $html2pdf = new Html2Pdf('P', 'A4', 'fr');
       $fichier = 'inscription_apprenant.pdf';
       $html2pdf->writeHTML($html);
       $html2pdf->output($fichier, 'D');
    }

     // fonction qui génère le pdf du dossier de pré-inscription
     #[Route('/pre_inscription/{id}', name: 'app_pre_inscription_apprenant_pdf', methods: ['GET'])]
     public function pdfPreInscrit(EntityManagerInterface $em, $id)
     {
        $pre_inscription = $em->getRepository(PreInscription::class)->find($id);
 
        $html = $this->renderView('pdf/pre_inscription_pdf.html.twig', [
         'pre_inscription' => $pre_inscription
        ]);
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $fichier = 'pre_inscription.pdf';
        $html2pdf->writeHTML($html);
        $html2pdf->output($fichier, 'D');
     }

    // fonction qui génère le pdf du formulaire de préinscription
    #[Route('/preinscription', name: 'app_preinscription_pdf')]
    public function pdfPreinscription() {

        $html = $this->renderView('pdf/preinscription_form.html.twig');
        $html2pdf = new Html2Pdf('P', 'A4');
        $fichier = 'formulaire_inscription.pdf';
        $html2pdf->writeHTML($html);
        $html2pdf->output($fichier, 'D');
    }

}
