<?php

namespace App\Form;

use App\Entity\PreInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreinscriptionCoordonneeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('n_ss')
            ->add('sexe')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('region')
            ->add('pays')
            ->add('telephone')
            ->add('email')
           
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PreInscription::class,
        ]);
    }
}
