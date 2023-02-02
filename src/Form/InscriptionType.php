<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateInscription', DateTimeType::class, [
                'widget'=>'single_text',
                'format'=>'dd/MM/yyyy',
                'html5'=>false,
                'attr'=>['class'=>'form-control', 'placeholder'=>'dd/mm/yyyy']
            ])
            ->add('echeance', IntegerType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Echéance']
            ])
            ->add('montant', NumberType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Montant']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
