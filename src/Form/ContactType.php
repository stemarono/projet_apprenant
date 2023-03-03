<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                    'placeholder' => 'E-mail'
                ] 
            ])
            ->add('objet', TextType::class, [
                'attr' => [
                    'class' => 'form-control my-3',
                    'placeholder' => 'Objet'
                ] 
            ])
            ->add('message', HiddenType::class)
            ->add('fichier', FileType::class, [
                'label' => 'Transmettre un formulaire rempli au format pdf',
                'label_attr' => ['class' => 'form-label text-secondary fw-lighter mt-3'],
                'attr' => ['class' => 'form-control my-3', 'type' => 'file'],
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
            ->add('envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn bg-green text-clear my-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
