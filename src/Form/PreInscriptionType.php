<?php

namespace App\Form;

use App\Entity\PreInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreInscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>'Nom :',
                'label_attr'=>['class'=>'me-3 mb-3']
            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom :',
                'label_attr'=>['class'=>'me-3 mb-3']
            ])
            ->add('dateNaissance',BirthdayType::class,[
                'label'=>'Date de Naissance :',
                'widget'=>'single_text',
                'html5'=>false,
                'format'=>'dd/mm/yyyy',
                'label_attr'=>['class'=>'me-3 mb-3']
            ])
            ->add('n_ss',textType::class,[
                'label'=>'Numéro de Sécurité Sociale :',
                'label_attr'=>['class'=>'me-3 mb-3']
            ])
            ->add('sexe',ChoiceType::class,[
                'label'=>'Sexe',
                'label_attr'=>['class'=>'me-3 mb-3'],
                'choices'=>[
                    'Femme'=>1,
                    'Homme'=>2,
                    'Autre'=>3,
                ]
            ])
            ->add('adresse',TextareaType::class,[
                'label'=> 'Adresse :',
                'label_attr'=>['class'=>'me-3 mb-3'],
            ])
            ->add('codePostal',NumberType::class,[
                'label'=>'Code Postal :',
                'label_attr'=>['class'=>'me-3 mb-3 '],
                'attr'=>['class'=>'d-inline w-20']
            ]
            )
            ->add('ville',TextType::class,[
                'label'=>'Ville :',
                'label_attr'=>['class'=>'me-3 mb-3 '],
                'attr'=>['class'=>'d-inline w-20']
            ])
            ->add('region',TextType::class,[
                'label'=> 'région :',
                'label_attr'=>['class'=>'me-3 mb-3'],
            ])
            ->add('pays',CountryType::class,[
                'label'=>'Pays :',
                'label_attr'=>['class'=>'me-3 mb-3'],
            ])
            ->add('telephone',NumberType::class,[
                'label'=> 'Téléphone',
                'label_attr'=>['class'=>'me-3 mb-3'],
            ])
            ->add('email',EmailType::class,[
                'label'=>' Adresse Mail :',
                'label_attr'=>['class'=>'me-3 mb-3'],
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
