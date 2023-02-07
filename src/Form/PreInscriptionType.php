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
                
            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom :',
               
            ])
            ->add('dateNaissance',BirthdayType::class,[
                'label'=>'Date de Naissance :',
                'widget'=>'single_text',
                'html5'=>false,
                'format'=>'dd/mm/yyyy',
                
            ])
            ->add('n_ss',textType::class,[
                'label'=>'Numéro de Sécurité Sociale :',
                
                
            ])
            ->add('sexe',ChoiceType::class,[
                'label'=>'Sexe :',
               
                'choices'=>[
                    'Femme'=>1,
                    'Homme'=>2,
                    'Autre'=>3,
                ],
                
            ])
            ->add('adresse',TextType::class,[
                'label'=> 'Adresse :',
               
            ])
            ->add('codePostal',NumberType::class,[
                'label'=>'Code Postal :',
                
            ]
            )
            ->add('ville',TextType::class,[
                'label'=>'Ville :',
               
            ])
            ->add('region',TextType::class,[
                'label'=> 'région :',
                
            ])
            ->add('pays',CountryType::class,[
                'label'=>'Veuillez sélectionner votre Pays :',
                
            ])
            ->add('telephone',NumberType::class,[
                'label'=> 'Téléphone',
                
            ])
            ->add('email',EmailType::class,[
                'label'=>' Adresse Mail :',
                
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
