<?php

namespace App\Entity;

use App\Repository\PreInscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PreInscriptionRepository::class)]
class PreInscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $sexe = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    private ?int $codePostal = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $pays = null;

    #[ORM\Column(nullable: true)]
    private ?int $telephone = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $motivations = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $financement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $carteIdentite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $justifFinancement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $carteVitale = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $autreDoc = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(?int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotivations(): ?string
    {
        return $this->motivations;
    }

    public function setMotivations(?string $motivations): self
    {
        $this->motivations = $motivations;

        return $this;
    }

    public function getFinancement(): ?string
    {
        return $this->financement;
    }

    public function setFinancement(?string $financement): self
    {
        $this->financement = $financement;

        return $this;
    }

    public function getCarteIdentite(): ?string
    {
        return $this->carteIdentite;
    }

    public function setCarteIdentite(?string $carteIdentite): self
    {
        $this->carteIdentite = $carteIdentite;

        return $this;
    }

    public function getJustifFinancement(): ?string
    {
        return $this->justifFinancement;
    }

    public function setJustifFinancement(?string $justifFinancement): self
    {
        $this->justifFinancement = $justifFinancement;

        return $this;
    }

    public function getCarteVitale(): ?string
    {
        return $this->carteVitale;
    }

    public function setCarteVitale(?string $carteVitale): self
    {
        $this->carteVitale = $carteVitale;

        return $this;
    }

    public function getAutreDoc(): ?string
    {
        return $this->autreDoc;
    }

    public function setAutreDoc(?string $autreDoc): self
    {
        $this->autreDoc = $autreDoc;

        return $this;
    }
}
