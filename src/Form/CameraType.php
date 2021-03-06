<?php

namespace App\Form;

use App\Entity\Camera;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Repository\ModeleRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;





class CameraType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque', EntityType::class, [
                'class'         => Marque::class,
                'label'         => false,
                'attr'          => [
                    'class'     => 'js-marque-ajax'
                ],
                'placeholder'   => "Choisir la marque"
            ])
        ;

        $formModifier = function (FormInterface $form, Marque $marque = null) {
            $modele = null === $marque ? [] : $marque->getModeles();
            // Si Marque est à null
            if (null === $marque) {
                $marqueId= 0;
            }else{ 
                $marqueId= $marque->getId();
            }
 
            $form->add('modele', EntityType::class, [
                'class'         => Modele::class,
                'placeholder'   => 'Choisir le modèle',
                'label'         => false,
                'attr'          => ['class' => 'js-modele-ajax'],
                'choice_label'  =>'name',
                'required'      => false,
                // Voir ModeleRepository
                'query_builder' => function (ModeleRepository $repository) use ($marqueId)
                {
                    return $repository->getModeleQueryBuilder($marqueId);
                }
            ])
            ;
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) { 
                $data = $event->getData();
                $form = $event->getForm();
                $marque = null; 
                if ($data != null) {
                    $marque = $event->getData()->getMarque();
                    $formModifier($form, $marque);
                }
            }
        );

        $builder->get('marque')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $marque = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $marque);
            }
        );

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Camera::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'camera_item'
        ]);
    }
}
