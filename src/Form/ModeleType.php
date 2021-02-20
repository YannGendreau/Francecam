<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Modele;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModeleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque', EntityType::class, [
                'label' => false,
                    'class'         => Marque::class,
                    'placeholder'   => 'Choisir une marque de caméra',
                    'choice_label' => 'name',
                    // 'mapped'        => false,
                    'required'      => false,
                    'by_reference'  => false,
                    // 'multiple'       => true,
                    'auto_initialize'   => false,
                    // 'expanded' => true
            ])
            ->add('name', TextType::class, [

            ])
            ->add('description', TextareaType::class, [

            ])
            // ->add('image')
            ->add('noise', IntegerType::class, [

            ])
            ->add('shutter', ChoiceType::class, [
                'choices' => [
                    '90' => 1,
                    '174' => 2,
                    '180' => 3,
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            ->add('mount', ChoiceType::class, [
                'choices' => [
                    'Aaton universal' => 1,
                    'ARRI PL' => 2,
                    'ARRI MAXI PL' => 3,
                    'Bolex Bayonet ' => 4,
                    'D' => 5,
                    'CS' => 6,
                    'Panavision PV' => 7,
                    'Mitchell BNCR' => 8,
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            ->add('framerate', ChoiceType::class, [
                'choices' => [
                    '24' => 1,
                    '25' => 2,
                    '30' => 3,
                    '50' => 4,
                    '60' => 5,
                    '16' => 6,
                    '120' => 7,    
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ] )
            ->add('perfs', ChoiceType::class, [
                'choices' => [
                    '2' => 1,
                    '3' => 2,
                    '4' => 3,
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            ->add('magazine',  ChoiceType::class, [
                'choices' => [
                    'Coplanaire' => 1,
                    'Coaxial' => 2, 
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                ])
            ->add('voltage') 
            ->add('weight', IntegerType::class, [

                ])
            ->add('view')
            ->add('sync')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modele::class,
        ]);
    }
}
