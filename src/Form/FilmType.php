<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Form\CameraType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FilmType extends AbstractType
{

    // public function __construct()
    // {
    //     $this->marque = new ArrayCollection();
    // } 
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer le titre du film.']),
                ]])
            ->add('duree', IntegerType::class , [
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir la durée du film.']),
                    ]
            ])
            ->add('synopsis', TextareaType::class, [
                'label' => false,
                'constraints'=> [
                    new NotBlank(['message' => 'Veuillez saisir le synopsis du film.']),
                    new Length([
                        'max' => 500,
                        'maxMessage' => 'Le synopsis doit comporter au maximum {{ limit }} caractères'
                    ])
            ]] )
           
            ->add('sortie', ChoiceType::class, [
                'label' => false,
                'choices'       =>$this->getYears(1897),
                'placeholder'   => 'Choisir une année'
            ])
            
            ->add('genres', EntityType::class, [
                'label' => false,
                'class'         => Genre::class,
                'choice_label' => 'name',
                'placeholder'   => 'Choisir le(s) genre(s)',
                // 'mapped'        => true,
                'required'      => false,
                // 'by_reference'  => false,
                'multiple' => true,
                'expanded' => true
          
            ])
            ->add('marques', EntityType::class, [
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


            // ->add('camera', CollectionType::class, [
                
            //     'entry_type' => CameraType::class,
            //     'entry_options' => ['label' => false],
            //     // 'entry_options' => [
            //     //     'attr' => ['class' => 'email-box']
            //     // ],
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'required' => false,
            //     // 'prototype' => true
            // ])
        ;

        // $builder->get('marques')->addEventListener(
        //         FormEvents::POST_SUBMIT,
        //         function(FormEvent $event){
        //             $form = $event->getForm();
        //             $this->addCameraField($form->getParent(), $form->getData());
        //         });


        // $builder->add('marques', EntityType::class, [
        //         'label' => false,
        //         'class'         => Marque::class,
        //         'placeholder'   => 'Choisir une marque de caméra',
        //         'choice_label' => 'name',
        //         // 'mapped'        => false,
        //         'required'      => false,
        //         'by_reference'  => false,
        //         'multiple'       => true,
        //         'auto_initialize'   => false,
        //         'expanded' => true
        // ]);
        $builder->get('marques')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event){
                $form = $event->getForm();
                $this->addCameraField($form->getParent(), $form->getData());
                
                // $form->getParent()->add('modeles', EntityType::class, [
                //     'class'             => Modele::class,
                //     'placeholder'       => 'Sélectionnez le modèle',
                //     // 'choice_label'      => 'name',
                //     // 'mapped'            => false,
                //     'required'          => false,
                //     'auto_initialize'   => false,
                //     // 'choices'           => $marque->getModeles(),
                //     'choices'           => $form->getData()->getModeles(),
                //     // 'by_reference'  => false,
                //     'multiple' =>true
                // ]);
                 
            }
        );
        dump($builder->getForm());
       
          }

    private function addCameraField(FormInterface $form, ?Marque $marque)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'modeles',
            EntityType::class,
            null,
            [
                'class'           => Modele::class,
                'placeholder'     => 'Sélectionnez un modele',
                // 'mapped'          => false,
                'required'        => false,
                'auto_initialize' => false,
                'choices'         => $marque ? $marque->getModeles() : [],
                'multiple'          =>true
            ]
        );
        // $builder->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function (FormEvent $event) {
        //         $form = $event->getForm();
        //         $this->addVilleField($form->getParent(), $form->getData());
        //     }
        // );
        $form->add($builder->getForm());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }

    private function getYears($min, $max='current')
    {
        $years = range($min, ($max === 'current' ? date('Y') : $max));

        return array_combine($years, $years);
    }

    

    
}
