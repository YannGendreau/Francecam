<?php

namespace App\Form;

use App\Data\SearchHomeData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add ('r', TextType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => ' Rechercher un film, une caméra'
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchHomeData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
