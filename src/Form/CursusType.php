<?php

namespace App\Form;

use App\Entity\Cursus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CursusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeCursus', TextType::class, [
                'label_attr' => ['class' => 'd-none'],
                'attr' => ['class' => 'form-control my-4', 'placeholder' => 'Code']
            ])
            ->add('libelleCursus', TextType::class, [
                'label_attr' => ['class' => 'd-none'],
                'attr' => ['class' => 'form-control my-4', 'placeholder' => 'Libelle']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cursus::class,
        ]);
    }
}
