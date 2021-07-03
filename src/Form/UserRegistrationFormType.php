<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'lf--input',
                    'placeholder' => 'Nom'
                ],
                'label' => false,
                
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'lf--input',
                    'placeholder' => 'Email',
                    'autocomplete' => false
                ],
                'label' => false,
            ])
            ->add('plainPassword', RepeatedType::class, [

                'type' => PasswordType::class,
               
                'first_options' => [
                    'attr' => [
                        'class'=>'lf--input-repeated',
                        'placeholder' => 'Mot de passe'
                        ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez un mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit comporter au minimum {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                
                    'label' => false,
                ],
                'second_options' => [
                    'attr' => [
                        'class'=>'lf--input-repeated',
                        'placeholder' => 'Confirmer le mot de passe'
                        ],
                    // 'label' => 'Confirmer le mot de passe',
                    'label' => false,
                ],
                'invalid_message' => 'Les deux mots de passe doivent correspondre.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,

            ])

            ->add('termes', CheckboxType::class, [
                'label' =>false,
                'mapped' => false,
                'constraints' => new IsTrue(),
            ])

            ->add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'userCaptcha',
                'label' => false
              ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'register_item'
        ]);
    }
}
