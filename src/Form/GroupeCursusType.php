<?php

namespace App\Form;

use App\Entity\Cursus;
use App\Entity\GroupeCursus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupeCursusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeGpeCursus', TextType::class, [
                'label_attr' => ['class' => 'd-none'],
                'attr' => ['class' => 'form-control my-4', 'placeholder' => 'Code']
            ])
            ->add('libelleGpeCursus', TextType::class, [
                'label_attr' => ['class' => 'd-none'],
                'attr' => ['class' => 'form-control my-4', 'placeholder' => 'Libelle']
            ])
            ->add('dateDebut', DateTimeType::class, [
                'label_attr' => ['class' => 'd-none'],
                'widget'=>'single_text',
                'format'=>'dd/MM/yyyy',
                'html5'=>false,
                'attr'=>['class'=>'form-control my-4', 'placeholder'=>'dd/mm/yyyy']
            ])
            ->add('dateFin', DateTimeType::class, [
                'label_attr' => ['class' => 'd-none'],
                'widget'=>'single_text',
                'format'=>'dd/MM/yyyy',
                'html5'=>false,
                'attr'=>['class'=>'form-control my-4', 'placeholder'=>'dd/mm/yyyy']
            ])
            ->add('cursus', EntityType::class, [
                'label_attr' => ['class' => 'd-none'],
                'class' => Cursus::class,
                'attr' => ['class' => 'form-select my-4'],
                'placeholder' => 'Cursus'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GroupeCursus::class,
        ]);
    }
}
