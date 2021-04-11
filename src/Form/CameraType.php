<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Modele;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CameraType extends AbstractType
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
                    // 'expanded' => true
            ]);


            $builder->get('marque')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $marques = $form->getData();
                               
                $form->getParent()->add('modeles', EntityType::class, [
                    'label'             => false,
                    'class'             => Modele::class,
                    'placeholder'       => 'Choisir un modele',
                    'required'          => false,
                    'mapped'            => false,
                    'multiple'       => true,
                    'choices'           => $marques->getModeles()
                    // 'choice_value' => function (Marque $marque = null) {

                    //     return $marque ? $marque->getModeles() : '';
                    // },
                    // 'choices'           => $marques->getModeles(),
                    // 'query_builder'     => function (EntityRepository $er ){
                    //     return $er->createQueryBuilder('m')
                    //     ->select('m.modeles')
                    //     ;
                    // }
                ]);
            }
        );
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // 'data_class' => Modele::class,
        ]);
    }
}
