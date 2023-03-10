<?php

namespace App\Form;

use App\Entity\PreInscription;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>'Nom :',
                
            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom :',
                
            ])
            ->add('roles',ChoiceType::class,[
                'mapped'=>false,
                'multiple'=>true,
                'choices'=>[
                    'ROLE_USER'=>'ROLE_USER',
                    'ROLE_GESTIONNAIRE'=>'ROLE_GESTIONNAIRE',
                    'ROLE_ADMIN'=>'ROLE_ADMIN',
                    'ROLE_VISITOR'=>'ROLE_VISITOR'
                ],
            ])
            ->add('email',EmailType::class,[
                'label'=>'Adresse email :',
            ])
            ->add('password',PasswordType::class,[
                'mapped'=>false,
                'required'=>false,
                'label'=>'mot de passe :',
                
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
