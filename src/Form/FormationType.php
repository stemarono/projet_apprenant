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
                'label' => 'Code :',
                'attr' => ['class' => 'form-control']
            ])
            ->add('titre', TextType::class, [
                'label' => 'Titre :',
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'description :',
                'attr' => ['class' => 'form-control', 'rows' => '3']
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'contenu :',
                'attr' => ['class' => 'form-control', 'rows' => '10']
            ])
            ->add('photo', FileType::class, [
                'label' => 'Image :',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Choisir un fichier valide'
                    ])
                    ],
                'attr' => ['class' => 'form-control', 'type' => 'file']
            ])
            ->add('dateFormation', DateTimeType::class, [
                'widget' => 'single_text', 
                'format' => 'dd/mm/yyyy',
                'html5' => false,
                'label' => 'Date :',
                'attr' => ['class' => 'form-control', 'placeholder' => 'jj/mm/aaaa']
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
