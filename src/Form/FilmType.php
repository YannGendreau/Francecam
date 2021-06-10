<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Pays;
use App\Entity\Genre;
use App\Entity\Camera;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Cameras;
use App\Entity\Director;
use App\Entity\Dirphoto;
use App\Form\CameraType;
use Doctrine\ORM\EntityRepository;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Count;
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
    private $marque;
    private $modeleRepository;

    public function __construct(MarqueRepository $marque, ModeleRepository $modeleRepository)
    {
        $this->marque = $marque;
        $this->modeleRepository= $modeleRepository;
    }
    
    /**
     * Formulaire nouveau Film
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'         => false,
                'constraints'   => [
                    new NotBlank(['message' => 'Veuillez entrer le titre du film.']),
                ],
                'empty_data' => ''
                ])
            ->add('duree', IntegerType::class, [
                'label'         => false,
                'empty_data' => 'minutes',
                'constraints'   => [
                    new NotBlank(['message' => 'Veuillez saisir la durée du film.']),
                    ]
            ])
            ->add('synopsis', TextareaType::class, [
                'label'         => false,
                'constraints'   => [
                   
                    new NotBlank(['message' => 'Veuillez saisir le synopsis du film.']),
                    new Length([
                        'max'           => 255,
                        'maxMessage'    => 'Le synopsis doit comporter au maximum {{ limit }} caractères'
                    ])
                    ],
                'empty_data' => ''
            ])
           
            ->add('sortie', ChoiceType::class, [
                'label'             => false,
                'choices'           => $this->getYears(1897),
                'placeholder'       => 'Choisir une année',
                'constraints'   => [
                    new Length([
                        'max' => 4,
                        'maxMessage' => '{{limit}} chiffres maximum pour l\'année.']),
                    ],
                'empty_data' => ''
            ])
            
            ->add('genres', EntityType::class, [
                'label'             => false,
                'class'             => Genre::class,
                'constraints'   => [
                    new Count([
                        'max'           => 2,
                        'maxMessage'    => 'Maximum {{ limit }} genres'
                    ])
                    ],
                'choice_label'      => 'name',
                'placeholder'       => 'Choisir le(s) genre(s)',
                'required'          => false,
                'multiple'          => true,
                'expanded'          => true,
                'query_builder'     => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                    ->orderBy('g.name', 'ASC')
                    ;
                }
          
            ])
            ->add('pays', EntityType::class, [
                'label'             => false,
                'class'             => Pays::class,
                'choice_label'      => 'name',
                'placeholder'       => 'Pays de production',
                'required'          => false,
                'multiple'          => true,
          
            ])
    /*------CAMERA COLLECTIONTYPE a revoir-------------------------------------------------------
    
            // ->add('camera', CollectionType::class, [
            //     'entry_type' => CameraType::class,
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'label' => false,
            //     'required' => false,
            //     'prototype' => true,
            //     'block_name' => 'task_lists',
            //     // 'by_reference' => false
            // ])
    --------------------------------------------------------------------------*/
            ->add('posterFile', VichImageType::class, [
                'required'          => false,
                'label'             => false
            ])

          
            ->add('directors', EntityType::class, [
                'label'             => false,
                'class'             => Director::class,
                'placeholder'       => 'Réalisation',
                'required'          => false,
                'multiple'          => true,
            ])
            ->add('dirphoto', EntityType::class, [
                'label'             => false,
                'class'             => Dirphoto::class,
                'placeholder'       => 'Photographie',
                'required'          => false,
                'multiple'          => true,
            ])

            ->add('camera', EntityType::class, [
                'class'         => Camera::class,
                'placeholder'   => 'Choisir la camera',
                'label'         => false,
                // 'mapped'        => false,
                'attr'          => ['class' => 'cameras'],
                'choice_label'  =>'name',
                'required'      => false,
                'multiple'          => true,

                ])
                
        ;

            
        ;
          
}
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'film_item'
        ]);
    }

    private function getYears($min, $max='current')
    {
        $years = range($min, ($max === 'current' ? date('Y') : $max));

        return array_combine($years, $years);
    }

    

}   

