<?php

namespace App\Twig;

use App\Entity\Formation;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CatsExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('cats', [$this, 'getFormations'])
        ];
    }

    public function getFormations() {
        return $this->em->getRepository(Formation::class)->findBy([], ['titre' => 'ASC']);
    }
}
