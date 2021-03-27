<?php

namespace App\Form;

use App\Entity\Camera;
use App\Entity\Marque;
use App\Entity\Modele;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Camera1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'label' => false
            ])
            ->add('modele', EntityType::class, [
                'class' => Modele::class,
                'label' => false
            ])
        ;
        // $builder->get('marque')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function (FormEvent $event) {
        //         $form = $event->getForm();
        //         // dd($form->getData()->getModeles());
        //         $marques = $form->getData();
                               
        //         $form->getParent()->add('modele', EntityType::class, [
        //             'label'             => false,
        //             'class'             => Modele::class,
        //             'placeholder'       => 'Choisir un modele',
        //             'required'          => false,
        //             'mapped'            => false,
        //             'choices'           => $marques->getModeles(),
        //             // 'choice_value' => function (Marque $marque = null) {

        //             //     return $marque ? $marque->getModeles() : '';
        //             // },
        //             // 'choices'           => $marques->getModeles(),
        //             // 'query_builder'     => function (EntityRepository $er ){
        //             //     return $er->createQueryBuilder('m')
        //             //     ->select('m.modeles')
        //             //     ;
        //             // }
        //         ]);
                
        //     }
           
        // );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Camera::class,
        ]);
    }
}
