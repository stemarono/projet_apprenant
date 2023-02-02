<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column]
    private ?int $echeance = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $montant = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?GroupeCursus $GroupeCursus = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ModePaiement $ModePaiement = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Financement $Financement = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Parcours $Parcours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getEcheance(): ?int
    {
        return $this->echeance;
    }

    public function setEcheance(int $echeance): self
    {
        $this->echeance = $echeance;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getGroupeCursus(): ?GroupeCursus
    {
        return $this->GroupeCursus;
    }

    public function setGroupeCursus(?GroupeCursus $GroupeCursus): self
    {
        $this->GroupeCursus = $GroupeCursus;

        return $this;
    }

    public function getModePaiement(): ?ModePaiement
    {
        return $this->ModePaiement;
    }

    public function setModePaiement(?ModePaiement $ModePaiement): self
    {
        $this->ModePaiement = $ModePaiement;

        return $this;
    }

    public function getFinancement(): ?Financement
    {
        return $this->Financement;
    }

    public function setFinancement(?Financement $Financement): self
    {
        $this->Financement = $Financement;

        return $this;
    }

    public function getParcours(): ?Parcours
    {
        return $this->Parcours;
    }

    public function setParcours(?Parcours $Parcours): self
    {
        $this->Parcours = $Parcours;

        return $this;
    }
}
