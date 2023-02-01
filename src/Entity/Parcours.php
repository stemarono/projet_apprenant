<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcoursRepository::class)]
class Parcours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $codeParcours = null;

    #[ORM\Column(length: 30)]
    private ?string $libelleParcours = null;

    #[ORM\ManyToOne]
    private ?Formation $Formation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeParcours(): ?string
    {
        return $this->codeParcours;
    }

    public function setCodeParcours(string $codeParcours): self
    {
        $this->codeParcours = $codeParcours;

        return $this;
    }

    public function getLibelleParcours(): ?string
    {
        return $this->libelleParcours;
    }

    public function setLibelleParcours(string $libelleParcours): self
    {
        $this->libelleParcours = $libelleParcours;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->Formation;
    }

    public function setFormation(?Formation $Formation): self
    {
        $this->Formation = $Formation;

        return $this;
    }
}
