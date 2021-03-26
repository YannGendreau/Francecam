<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Pays;
use App\Entity\Genre;
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
use Doctrine\Common\Collections\ArrayCollection;
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
    //------CAMERA-------------------------------------------------------
    

            // Ajouter une marque
            ->add('marques', EntityType::class, [
                'label'             => false,
                'class'             => Marque::class,
                'placeholder'       => 'Choisir une marque de caméra',
                'required'          => false,
                'multiple'          => true,
            ])

            //TEMPORAIRE
            //En attendant de trouver le moyen de créer un formulaire dynamique de choix de caméras
            ->add('modeles', EntityType::class, [
                'label'             => false,
                'class'             => Modele::class,
                'placeholder'       => 'Choisir une caméra',
                'required'          => false,
                'multiple'          => true,

            ])

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
            ]);
            // ->add('marques', EntityType::class, [
            //     'class'       => Marque::class,
            //     // 'placeholder' => 'Sélectionnez votre marque',
            //     'mapped'      => false,
            //     'required'    => false
            // ]);

        // $builder->get('marques')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function (FormEvent $event) {
        //         $form = $event->getForm();
        //         $this->addModeleField($form->getParent(), $form->getData());
        //     }
        // );

        // $builder->addEventListener(
        //     FormEvents::POST_SET_DATA,
        //     function (FormEvent $event) {
        //         $data = $event->getData();
        //         /* @var $ville Ville */
        //         // $ville = $data->getVille();
        //         $form = $event->getForm();
        //         if ($ville) {
        //             $departement = $ville->getDepartement();
        //             $region = $departement->getRegion();
        //             $this->addModeleField($form, $marques);
        //             $form->get('region')->setData($marques);
        //             $form->get('modeles')->setData($modeles);
        //         } else {
        //             $this->addModeleField($form, null);
        //             // $this->addVilleField($form, null);
        //         }
        //     }
        // );
    }

    // /**
    //  * Rajoute un champs marque au formulaire
    //  * @param FormInterface $form
    //  * @param Marque $marque
    //  */
    // private function addModeleField(FormInterface $form, ?Marque $marque)
    // {
    //     $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
    //         'modeles',
    //         EntityType::class,
    //         null,
    //         [
    //             'class'           => Modele::class,
    //             'placeholder'     => $marque ? 'Sélectionnez votre modele' : 'Sélectionnez votre marque',
    //             'mapped'          => false,
    //             'required'        => false,
    //             'auto_initialize' => false,
    //             'choices'         => $marque ? $marque->getModeles() : []
    //         ]
    //     );
        
    //     $form->add($builder->getForm());
    // }

        
        
    // TENTATIVE DE FORMULAIRE IMBRIQUE. NE MARCHE PAS (Arraycollection)
// Cherche a pouvoir ajouter une ou des caméras pour un film.
// Si le modèle de la caméra est inconnu, on peut choisir seulement la marque



        // $builder->get('marques')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function (FormEvent $event) {
        //         $form = $event->getForm();
        //         dump($form->getData());
        //         // $marques = $form->getData();
                      
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
        // )
 

          
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

