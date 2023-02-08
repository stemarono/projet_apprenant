<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control me-2',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control ms-2',
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'E-mail'
                ] 
            ])
            ->add('objet', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Objet'
                ] 
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Message',
                    'rows' => '5'
                ] 
            ])
            ->add('fichier', FileType::class, [
                'label' => 'Transmettre un formulaire rempli au format pdf',
                'label_attr' => ['class' => 'form-label text-secondary fw-lighter mt-3'],
                'attr' => ['class' => 'form-control', 'type' => 'file'],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1000k',
                        'mimeTypes' => [
                            'application/pdf'
                        ],
                        'mimeTypesMessage' => 'Choisir un fichier au format pdf'
                    ])
                ]
            ])
            ->add('envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn bg-green text-clear'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
