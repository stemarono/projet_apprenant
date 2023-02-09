<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Parcours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Code']
            ])
            ->add('titre', TextType::class, [

                'attr' => ['class' => 'form-control', 'placeholder' => 'Titre']
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Description']
            ])
            ->add('contenu', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'rows' => '10', 'placeholder' => 'Contenu']
            ])
            ->add('photo', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    // new File([
                    //     'maxSize' => '1024k',
                    //     'mimeTypes' => [
                    //         'images/*',
                    //     ],
                    //     'mimeTypesMessage' => 'Choisir un fichier valide'
                    // ])
                    ],
                'attr' => ['class' => 'form-control', 'type' => 'file']
            ])
            ->add('dateFormation', DateTimeType::class, [
                'widget' => 'single_text', 
                'format' => 'dd/mm/yyyy',
                'html5' => false,
                'attr' => ['class' => 'form-control datepicker', 'placeholder' => 'Date']
            ])
            ->add('parcours', EntityType::class, [
                'class' => Parcours::class,
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Parcours'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
