<?php

namespace App\Entity;

use App\Repository\ModePaiementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModePaiementRepository::class)]
class ModePaiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $codeModePaie = null;

    #[ORM\Column(length: 30)]
    private ?string $libelleModePaie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeModePaie(): ?string
    {
        return $this->codeModePaie;
    }

    public function setCodeModePaie(string $codeModePaie): self
    {
        $this->codeModePaie = $codeModePaie;

        return $this;
    }

    public function getLibelleModePaie(): ?string
    {
        return $this->libelleModePaie;
    }

    public function setLibelleModePaie(string $libelleModePaie): self
    {
        $this->libelleModePaie = $libelleModePaie;

        return $this;
    }

    public function __toString()
    {
        return $this->libelleModePaie;
    }
}
