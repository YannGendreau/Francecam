<?php
namespace App\Form;
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
            ->add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'ContactCaptcha',
                'label' => false
              ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'contact_item',
            'data_class' => Contact::class,

        ]);
    }
}