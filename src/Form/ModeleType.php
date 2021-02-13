<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Modele;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                    'multiple'       => true,
                    'auto_initialize'   => false,
                    'expanded' => true
            ])
            ->add('name')
            ->add('description')
            // ->add('image')
            ->add('noise')
            ->add('shutter')
            ->add('mount')
            ->add('framerate')
            ->add('perfs')
            ->add('magazine')
            ->add('voltage')
            ->add('weight')
            ->add('view')
            ->add('sync')
            // ->add('marque')
            // ->add('films')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modele::class,
        ]);
    }
}
