<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Role;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rang')
            ->add('libelle')
            ->add('route')
            ->add('role', EntityType::class, [
                'class' => Role::class, 
                'choice_label' => 'libelle'
            ])
            ->add('parent', EntityType::class, [
                'class' => Menu::class,
                'required' => false,
                'choice_label' => 'libelle',
                'placeholder' => 'Laisser vide si pas de parent'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
