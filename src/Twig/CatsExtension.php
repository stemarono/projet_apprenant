<?php

namespace App\Twig;

use App\Entity\Formation;
use App\Entity\Menu;
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
            new TwigFunction('cats', [$this, 'getFormations', 'getMenus'])
        ];
    }

    public function getFormations() {
        return $this->em->getRepository(Formation::class)->findBy([], ['titre' => 'ASC']);
    }

    public function getMenus() {
        return $this->em->getRepository(Menu::class)->findAll();
    }
}
