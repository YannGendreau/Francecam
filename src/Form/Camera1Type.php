<?php

namespace App\Form;

use App\Entity\Camera;
use App\Entity\Marque;
use App\Entity\Modele;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
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
            // ->add('modele', EntityType::class, [
            //     'class' => Modele::class,
            //     'label' => false
            // ])
        ;
        $builder->get('marque')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addModeleField($form->getParent(), $form->getData());
                
            }
           
        );

        // $builder->addEventListener(
        //     FormEvents::POST_SET_DATA,
        //     function (FormEvent $event) {
        //         $data = $event->getData();
            
        //         /**  @var $modele Modele */
        //         $modele = $data->getModeles();
         
        //         $form = $event->getForm();
        //         if ($modele) {
        //             $marque = $modele->getMarque();
        //             $this->addModeleField($form, $marque);
        //             $form->get('marque')->setData($marque);
        //         } else {
                  
        //             $this->addModeleField($form, null);
        //         }
        //     }
        // );
    }

    private function addModeleField(FormInterface $form, ?Marque $marque)
    {
        $form->add('modele', EntityType::class, [
            'class'       => Modele::class,
            'placeholder' => $marque ? 'Sélectionnez le modèle' : 'Sélectionnez la marque',
            'choices'     => $marque ? $marque->getModeles() : []
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Camera::class,
        ]);
    }
}
