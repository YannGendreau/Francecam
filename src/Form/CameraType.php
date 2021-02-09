<?php

namespace App\Form;

use App\Entity\Camera;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Repository\CameraRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class CameraType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('marque', ChoiceType::class, [
                
            // ])
            ->add('marque', EntityType::class, [
                'label'         => false,
                'class'         => Marque::class,
                // 'choice_label'  => 'name',
                'placeholder'   => 'Choisir la marque',
                'mapped'        => true,
                'required'      => false,
                'by_reference'  => false,
                // 'multiple'      => true,
                // 'expanded'      => true,
                
            ])
            ->add('modele', EntityType::class, [
                'label'         => false,
                'class'         => Modele::class,
                // 'choice_label'  => 'name',
                'placeholder'   => 'Choisir la marque',
                'mapped'        => true,
                'required'      => false,
                'by_reference'  => false,
                // 'multiple'      => true,
                // 'expanded'      => true,
                
            ])
        ;
        //  $builder->get('marque')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function(FormEvent $event){
        //         $form = $event->getForm();
        //     //   dd($form->getData());
        //         $form->getParent()->add('modele', EntityType::class, [
        //             'class'             => Modele::class,
        //             'placeholder'       => 'Sélectionnez le modèle',
        //             // 'choice_label'      => 'name',
        //             'mapped'            => false,
        //             'required'          => false,
        //             'auto_initialize'   => false,
        //             // 'choices'           => $camera->getModeles(),
        //             // 'choices'           => $form->getData()->getModeles(),
        //             'by_reference'  => false,
        //         ]);
                 
        //     }
        // );
    }

    // public function marqueNames()
    // {
    //     return $camera->getMarque();
    // }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Camera::class,
        ]);
    }
}
