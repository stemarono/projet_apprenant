<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identifiant')
            ->add('prenom')
            ->add('nom')
            ->add('dateNaissance')
            ->add('sexe')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('region')
            ->add('pays')
            ->add('telephone')
            ->add('email')
            ->add('numSecu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
