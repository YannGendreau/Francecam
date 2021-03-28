<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, [
                'attr' => [
                    'class' => 'lf--input',
                    'placeholder' => 'Nom',
                    'autocomplete' => false
                ],
                'label' => false,
            ])
            ->add('email',EmailType::class, [
                'attr' => [
                    'class' => 'lf--input',
                    'placeholder' => 'Email',
                    'autocomplete' => false
                ],
                'label' => false,
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'lf--message',
                    'rows' => 6,
                    'rows' => '5',
                    'placeholder' => 'Votre message',
                    'autocomplete' => false,
                    'trim' => true,
                   
                ],
                'label' => false,
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}