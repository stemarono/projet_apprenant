<?php

namespace App\Form;

use App\Entity\PreInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreInscriptionJustifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
            ->add('carteIdentite')
            ->add('justifFinancement')
            ->add('carteVitale')
            ->add('autreDoc')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PreInscription::class,
        ]);
    }
}
