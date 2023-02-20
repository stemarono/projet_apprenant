<?php

namespace App\Form;

use App\Entity\Cursus;
use App\Entity\Financement;
use App\Entity\GroupeCursus;
use App\Entity\InscriptionApprenant;
use App\Entity\ModePaiement;
use App\Entity\Parcours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionApprenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identifiant', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Identifiant']
            ])
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom']
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom']
            ])
            ->add('dateNaissance', BirthdayType::class, [
                'widget'=>'single_text',
                'format'=>'dd/mm/yyyy',
                'html5'=>false,
                'attr' => ['class' => 'form-control datepicker', 'placeholder' => 'Date de naissance']
            ])
            ->add('sexe', ChoiceType::class, [
                'attr' => ['class' => 'form-select'],
                'choices' => [
                    'Sélectionner un sexe' => null,
                    'Femme' => 02,
                    'Homme' => 01,
                    'Autre' => 03
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse']
            ])
            ->add('codePostal', IntegerType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Code Postal']
            ])
            ->add('ville', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ville']
            ])
            ->add('region', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Région']
            ])
            ->add('pays', CountryType::class, [
                'attr' => ['class' => 'form-select', 'placeholder' => 'Pays'],
                'placeholder' => 'Sélectionner un pays'
            ])
            ->add('telephone', IntegerType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Téléphone']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'E-mail']
            ])
            ->add('numSecu', IntegerType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro de sécurité sociale']
            ])
            ->add('dateInscription', DateType::class, [
                'widget'=>'single_text',
                'format'=>'dd/mm/yyyy',
                'html5'=>false,
                'attr' => ['class' => 'form-control datepicker', 'placeholder' => 'Date d\'inscription']
            ])
            ->add('groupeCursus', EntityType::class, [
                'class' => GroupeCursus::class,
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Sélectionner un groupe'
            ])
            ->add('cursus', EntityType::class, [
                'class' => Cursus::class,
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Sélectionner un cursus'
            ])
            ->add('parcours', EntityType::class, [
                'class' => Parcours::class,
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Sélectionner un parcours'
            ])
            ->add('financement', EntityType::class, [
                'class' => Financement::class,
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Sélectionner un financement'
            ])
            ->add('modePaiement', EntityType::class, [
                'class' => ModePaiement::class,
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Sélectionner un mode de paiement'
            ])
            ->add('montant', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Montant']
            ])
            ->add('nbEcheance', IntegerType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nombre d\'échéances']
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
            'data_class' => InscriptionApprenant::class,
        ]);
    }
}
