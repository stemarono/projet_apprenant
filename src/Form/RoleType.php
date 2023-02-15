<?php

namespace App\Form;

use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code_role',TextType::class,[
            'label'=>'Rang :' ,
            'label_attr'=>['class'=>"m-5"],
            'attr'=>['class'=>'m-3']
            ])
            ->add('libelle',TextType::class,[
                'label'=>'Libellé :',
                'label_attr'=>['class'=> "m-5"]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Role::class,
        ]);
    }
}
