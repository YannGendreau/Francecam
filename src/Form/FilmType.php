<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Cameras;
use App\Entity\Director;
use App\Entity\Dirphoto;
use App\Entity\Pays;
use Doctrine\ORM\EntityRepository;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\Count;

class FilmType extends AbstractType
{
    private $marque;

    public function __construct(MarqueRepository $marque)
    {
        $this->marque = $marque;
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
                ]])
            ->add('duree', IntegerType::class, [
                'label'         => false,
                'constraints'   => [
                    new NotBlank(['message' => 'Veuillez saisir la durée du film.']),
                    ]
            ])
            ->add('synopsis', TextareaType::class, [
                'label'         => false,
                'constraints'   => [
                    new NotBlank(['message' => 'Veuillez saisir le synopsis du film.']),
                    new Length([
                        'max'           => 500,
                        'maxMessage'    => 'Le synopsis doit comporter au maximum {{ limit }} caractères'
                    ])
            ]])
           
            ->add('sortie', ChoiceType::class, [
                'label'             => false,
                'choices'           => $this->getYears(1897),
                'placeholder'       => 'Choisir une année'
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
                'expanded'          => true
          
            ])
            ->add('pays', EntityType::class, [
                'label'             => false,
                'class'             => Pays::class,
                'choice_label'      => 'name',
                'placeholder'       => 'Pays de production',
                'required'          => false,
                'multiple'          => true,
          
            ])
    //------CAMERA-------------------------------------------------------
    
            //Ajouter une marque
            ->add('marques', EntityType::class, [
                'label'             => false,
                'class'             => Marque::class,
                'placeholder'       => 'Choisir une marque de caméra',
                'required'          => false,
                'multiple'          => true,
            ])

            //TEMPORAIRE
            //En attendant de trouver le moyen de créer un formulaire dynamique de choix de caméras
            ->add('cameraModele', EntityType::class, [
                'label'             => false,
                'class'             => Cameras::class,
                'placeholder'       => 'Choisir une caméra',
                'required'          => false,
                'multiple'          => true,

            ])

            ->add('posterFile', VichImageType::class, [
                'required'          => false,
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
        ;
        
// TENTATIVE DE FORMULAIRE IMBRIQUE. NE MARCHE PAS (Arraycollection)
// Cherche a pouvoir ajouter une ou des caméras pour un film.
// Si le modèle de la caméra est inconnu, on peut choisir seulement la marque


        // $builder->get('marques')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function (FormEvent $event) {
        //         $form = $event->getForm();
        //         dd($form->getData());
        //         $marques = $form->getData();
               
                
        //         $form->getParent()->add('modeles', EntityType::class, [
        //             'label'             => false,
        //             'class'             => Modele::class,
        //             'placeholder'       => 'Choisir un modele',
        //             'required'          => false,
        //             'mapped'            => false,
        //             'choices'           => $form->getData()->getModeles(),
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
            'data_class' => Film::class,
        ]);
    }

    private function getYears($min, $max='current')
    {
        $years = range($min, ($max === 'current' ? date('Y') : $max));

        return array_combine($years, $years);
    }

    

    
}
