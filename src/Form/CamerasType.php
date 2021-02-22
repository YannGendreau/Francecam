<?php

namespace App\Form;

use App\Entity\Cameras;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CamerasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('description')
            ->add('noise')
            ->add('mount')
            ->add('voltage')
            ->add('weight')
            ->add('view')
            ->add('slug')
            ->add('films')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cameras::class,
        ]);
    }
}
