<?php

namespace App\Entity;

use App\Repository\CursusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursusRepository::class)]
class Cursus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $codeCursus = null;

    #[ORM\Column(length: 30)]
    private ?string $libelleCursus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCursus(): ?string
    {
        return $this->codeCursus;
    }

    public function setCodeCursus(string $codeCursus): self
    {
        $this->codeCursus = $codeCursus;

        return $this;
    }

    public function getLibelleCursus(): ?string
    {
        return $this->libelleCursus;
    }

    public function setLibelleCursus(string $libelleCursus): self
    {
        $this->libelleCursus = $libelleCursus;

        return $this;
    }

    public function __toString() {
        return $this->libelleCursus;
    }
}
