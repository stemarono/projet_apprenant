<?php

namespace App\Entity;

use App\Repository\GroupeCursusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeCursusRepository::class)]
class GroupeCursus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $codeGpeCursus = null;

    #[ORM\Column(length: 30)]
    private ?string $libelleGpeCursus = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\ManyToOne]
    private ?Cursus $Cursus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeGpeCursus(): ?string
    {
        return $this->codeGpeCursus;
    }

    public function setCodeGpeCursus(string $codeGpeCursus): self
    {
        $this->codeGpeCursus = $codeGpeCursus;

        return $this;
    }

    public function getLibelleGpeCursus(): ?string
    {
        return $this->libelleGpeCursus;
    }

    public function setLibelleGpeCursus(string $libelleGpeCursus): self
    {
        $this->libelleGpeCursus = $libelleGpeCursus;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getCursus(): ?Cursus
    {
        return $this->Cursus;
    }

    public function setCursus(?Cursus $Cursus): self
    {
        $this->Cursus = $Cursus;

        return $this;
    }

    public function __toString()
    {
        // $libelle = $this->libelleGpeCursus;
        // $dateDebut = $this->dateDebut;
        // $dateFin = $this->dateFin;
        // return "$libelle | du $dateDebut au $dateFin";
        return $this->libelleGpeCursus;
    }
}
