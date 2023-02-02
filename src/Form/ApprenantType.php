<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identifiant', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Identifiant']
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom']
            ])
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom']
            ])
            ->add('dateNaissance', BirthdayType::class, [
                'mapped' => false,
                'widget'=>'single_text',
                'format'=>'dd/MM/yyyy',
                'html5'=>false,
                'attr'=>['class'=>'form-control', 'placeholder'=>'Date de naissance'],
            ])
            ->add('sexe', ChoiceType::class, [
                'attr' => ['class' => 'form-select'],
                'choices' => [
                    'Sexe' => null,
                    'Femme' => 02,
                    'Homme' => 01,
                    'Autre' => 03,
                ],
            ])
            ->add('adresse', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse', 'rows' => '2']
            ])
            ->add('codePostal', IntegerType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Code postal']
            ])
            ->add('ville', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ville']
            ])
            ->add('region', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Région']
            ])
            ->add('pays', CountryType::class, [
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Pays',
            ])
            ->add('telephone', IntegerType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Téléphone']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Email']
            ])
            ->add('numSecu', IntegerType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro de sécurité sociale']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
