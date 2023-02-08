<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;//Un slugger transforme une chaîne donnée en une autre chaîne qui n’inclut que les caractères ASCII sécurisés

class FileUploader
{
    private $targetDirectory;
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory=$targetDirectory;
        $this->slugger=$slugger;
        
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename=pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME); //pathinfo =>moyen d'identifier une dde, Retourne des informations sur un chemin système (voir PHP.NET)
        //permet d'inclure en toute sécurité le nom du fichier dans l'url
        $safeFilename=$this->slugger->slug($originalFilename);
        $fileName=$safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try{

            $file->move($this->getTargetDirectory(),$fileName);
        }catch(FileException $e)
        {
            return null;
        }
        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}