<?php

namespace App\Entity;

use App\Repository\FinancementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FinancementRepository::class)]
class Financement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $codeFinancement = null;

    #[ORM\Column(length: 30)]
    private ?string $libelleFinancement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeFinancement(): ?string
    {
        return $this->codeFinancement;
    }

    public function setCodeFinancement(string $codeFinancement): self
    {
        $this->codeFinancement = $codeFinancement;

        return $this;
    }

    public function getLibelleFinancement(): ?string
    {
        return $this->libelleFinancement;
    }

    public function setLibelleFinancement(string $libelleFinancement): self
    {
        $this->libelleFinancement = $libelleFinancement;

        return $this;
    }
}
