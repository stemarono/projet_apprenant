<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Role;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rang', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Rang']
            ])
            ->add('libelle', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Libelle']
            ])
            ->add('route', TextType::class, [
                'required'=>false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Route']
            ])
            ->add('role', EntityType::class, [
                'class' => Role::class, 
                'attr' => ['class' => 'form-control'],
                'choice_label' => 'libelle'
            ])
            ->add('parent', EntityType::class, [
                'class' => Menu::class,
                'attr' => ['class' => 'form-control'],
                'required' => false,
                'choice_label' => 'libelle',
                'placeholder' => 'Laisser vide si aucun parent'
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
