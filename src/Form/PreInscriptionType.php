<?php

namespace App\Form;

use App\Entity\PreInscription;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PreInscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user',EntityType::class,[
                'class'=>User::class,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Login'],
                'placeholder'=>'Login',
                'required'=>false,
            ])
            
            ->add('nom',TextType::class,[
                
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom']
            ])
            ->add('prenom',TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom']
               
            ])
            ->add('dateNaissance',BirthdayType::class,[
                'widget'=>'single_text',
                'format'=>'dd/mm/yyyy',
                'html5'=>false,
                'attr' => ['class' => 'form-control datepicker', 'placeholder' => ' Date de naissance']
            ])
            ->add('n_ss',textType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro de sécurité sociale'] 
            ])
            ->add('sexe',ChoiceType::class,[
                'attr' => ['class' => 'form-select'],
                'choices' => [
                    'Sélectionner un sexe' => null,
                    'Femme' => 'Femme',
                    'Homme' => 'Homme',
                    'Autre' => 'Autre'
                ]
            ])
            ->add('adresse',TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse']
               
            ])
            ->add('codePostal',NumberType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Code postal']
                
            ]
            )
            ->add('ville',TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ville']
               
            ])
            ->add('region',TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Région']
                
            ])
            ->add('pays',CountryType::class,[
                'attr' => ['class' => 'form-select', 'placeholder' => 'Pays'],
                'placeholder' => 'Sélectionner un pays'
                
            ])
            ->add('telephone',NumberType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Téléphone']
                
            ])
            ->add('email',EmailType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'E-mail']
                
            ])
            ->add('motivations', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control', 
                    'placeholder' => 'Expliquez en quelques phrases vos motivations (1000 caractères maximum)',
                    'rows' => '6'
                    ]
            ])
            ->add('financement', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control', 
                    'placeholder' => 'Quelle formation souhaitez-vous suivre ? Quel type de financement souhaitez-vous ? (500 caractères maximum)',
                    'rows' => '5'
                    ]
            ])

            ->add('carteIdentite', FileType::class, [
                'label' => 'carte d\'identité : ',
                'label_attr' => ['class' => 'form-label text-secondary fw-lighter mt-3'],
                'attr' => ['class' => 'form-control', 'type' => 'file'],
                'mapped' => false,
                'required' => false,
                'constraints' => [

                    new File([
                        'maxSize' => '1000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf,'
                        ],
                        'mimeTypesMessage' => 'Choisir un fichier au format pdf'
                    ])
                ]
            ])
            ->add('justifFinancement', FileType::class, [

                'label' => 'justificatif de financement : ',
                'label_attr' => ['class' => 'form-label text-secondary fw-lighter mt-3'],
                'attr' => ['class' => 'form-control', 'type' => 'file'],
                'mapped' => false,
                'required' => false,
                'constraints' => [

                    new File([
                        'maxSize' => '1000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf,'
                        ],
                        'mimeTypesMessage' => 'Choisir un fichier au format pdf'
                    ])
                ]
            ])
            ->add('carteVitale', FileType::class, [

                'label' => 'attestation de carte vitale : ',
                'label_attr' => ['class' => 'form-label text-secondary fw-lighter mt-3'],
                'attr' => ['class' => 'form-control', 'type' => 'file'],
                'mapped' => false,
                'required' => false,
                'constraints' => [

                    new File([
                        'maxSize' => '1000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf,'
                        ],
                        'mimeTypesMessage' => 'Choisir un fichier au format pdf'
                    ])
                ]
            ])
            ->add('autreDoc', FileType::class, [

                'label' => 'autre document : ',
                'label_attr' => ['class' => 'form-label text-secondary fw-lighter mt-3'],
                'attr' => ['class' => 'form-control', 'type' => 'file'],
                'mapped' => false,
                'required' => false,
                'constraints' => [

                    new File([
                        'maxSize' => '1000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf,'
                        ],
                        'mimeTypesMessage' => 'Choisir un fichier au format pdf'
                    ])
                ]
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn bg-green text-clear',
                    'data-bs-toggle' => 'modal',
                    'data-bs-target' => '#validationModal'
                ]
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
