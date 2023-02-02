<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['class' => 'form-control me-1', 'placeholder' => 'Prénom']
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['class' => 'form-control ms-1', 'placeholder' => 'Nom']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Email', 'type' => 'email']
            ])
            ->add('object', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Objet']
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Votre message ici', 'rows' => '5']
            ])
            ->add('file', FileType::class, [
                'label' => 'Transmettre un formulaire rempli au format pdf',
                'label_attr' => ['class' => 'form-label text-secondary fw-lighter'],
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
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}