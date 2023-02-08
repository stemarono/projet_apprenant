<?php

namespace App\Form;

use App\Entity\PreInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreInscriptionJustifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
            ->add('carteIdentite',FileType::class,[
                'label'=>'Carte d\'identité :',
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('justifFinancement',FileType::class,[
                'label'=>' Justificatifs de financement :',
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('carteVitale',FileType::class,[
                'label'=>'attestation de la carte Vitale :',
                'mapped'=>false,
                'required'=>false,

            ])
            ->add('autreDoc',FileType::class,[
                'label'=>'Autre Document :',
                'mapped'=>false,
                'required'=> false,
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PreInscription::class,
        ]);
    }
}
