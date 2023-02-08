<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>'Nom :',
                'label_attr'=>['class'=>'mx-5 mb-3'],
                'attr'=>['form-control']
            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom :',
                'label_attr'=>['class'=>'mx-5 mb-3'],
                'attr'=>['form-control ']
            ])
            ->add('identifiant',TextType::class,[
                'label'=>'identifiant :',
                'label_attr'=>['class'=>'mx-5 mb-3'],
                'attr'=>['form-control']
            ])
            ->add('roles',ChoiceType::class,[
                'mapped'=>false,
                'choices'=>[
                       'ROLE_USER'=> 'ROLE_USER',
                       'ROLE_GESTIONNAIRE'=> 'ROLE_GESTIONNAIRE',
                       'ROLE_ADMIN'=> 'ROLE_ADMIN',
                   ],
                'label'=>'Roles',
                'label_attr'=>['class'=>'mx-5 mb-3'],
                'attr'=>['form-control']
            ])
            ->add('email',EmailType::class,[
                'label'=>'adresse email :',
                'label_attr'=>['class'=>'mx-5 mb-3'],
                'attr'=>['form-control']
            ])
            ->add('password',PasswordType::class,[
                'mapped'=>true,
                'required'=>false,
                'label'=>'Mot de passe',
                'label_attr'=>['class'=>'mx-5 mb-3'],
                'attr'=>['form-control']
            ]);
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
