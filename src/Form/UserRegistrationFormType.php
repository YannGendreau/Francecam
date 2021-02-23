<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'lf--input'
                ],
                'label' => false,
                
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'lf--input'
                ],
                'label' => false,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'label'             =>false,
                'mapped'             => false,
                'type'               => PasswordType::class,
                'invalid_message'    => 'Les mots de passe doivent correspondre. .',
                'options' => 
                    ['attr' => ['class' => 'password-field, lf--input']],
                'required'           => true,
                // 'first_options'      => ['label' => 'Mot de passe'],
                // 'second_options'     => ['label' => 'Confirmer le mot de passe'],
                'constraints'        => [
                    new NotBlank,
                    new Length(['min' => 6, 'max' => 4096])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
