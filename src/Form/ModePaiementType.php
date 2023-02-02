<?php

namespace App\Form;

use App\Entity\ModePaiement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModePaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeModePaie', TextType::class, [
                'label_attr' => ['class' => 'd-none'],
                'attr' => ['class' => 'form-control my-4', 'placeholder' => 'Code']
            ])
            ->add('libelleModePaie', TextType::class, [
                'label_attr' => ['class' => 'd-none'],
                'attr' => ['class' => 'form-control my-4', 'placeholder' => 'Libelle']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ModePaiement::class,
        ]);
    }
}
