<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Form\CameraType;
use App\Form\ModeleType;
use App\Form\CameraFormType;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
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
    private $marque;

    public function __construct(Marque $marque)
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
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer le titre du film.']),
                ]])
            ->add('duree', IntegerType::class, [
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
            ]])
           
            ->add('sortie', ChoiceType::class, [
                'label' => false,
                'choices'       =>$this->getYears(1897),
                'placeholder'   => 'Choisir une année'
            ])
            
            ->add('genres', EntityType::class, [
                'label' => false,
                'class'         => Genre::class,
                'choice_label'  => 'name',
                'placeholder'   => 'Choisir le(s) genre(s)',
                'required'      => false,
                'multiple'      => true,
                'expanded'      => true
          
            ])          
            ->add('marques', EntityType::class, [
                'label' => false,
                'class'             => Marque::class,
                'placeholder'       => 'Choisir une marque de caméra',
                'choice_label'      => 'name',
                'required'          => false,
                'by_reference'      => false,
                'auto_initialize'   => false,
                'multiple'          => true
 
            ])
        



        // $builder->get('marques')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function (FormEvent $event){
        //         $form = $event->getForm();
        //         // dd($form->getParent());
        //         $form->getParent()->add('modeles', EntityType::class, [
        //             'class'             => Modele::class,
        //             'placeholder'       => 'Sélectionnez le modele',
        //             // 'mapped'            => false,
        //             // 'required'          => false,
        //             // 'auto_initialize'   => false,
        //             'choices'           => $form->getData()->getModeles(),
        //             // 'by_reference'      => false,
        //             // 'multiple'          => true,
        //             // 'expanded'          => false,
        //         //     'query_builder' => function (ModeleRepository $er) {
        //         //         return $er->createQueryBuilder('m')
        //         //             ->select('m.name');
        //         //     }
        //         ]);
            
        //     }
        // )
;
       
        $formModele = function (FormInterface $form, Marque $marque = null) {
            // Renvoie un formulaire avec la liste des modeles
            // Array vide si null
            $modeles = null === $marque ? [] : $marque->getModeles();

            $form->add('modeles', EntityType::class, [
                    'class'             => Modele::class,
                    'placeholder'       => 'choisir le modele',
                    'choices'           => $modeles,
                    'multiple'          => true,
                    'required'          => false,
                    'by_reference'      => false,
                    // 'auto_initialize'   => false,
            ]);
        }
    ;
        // $builder->addEventListener(
        //     FormEvents::PRE_SUBMIT,
        //     function (FormEvent $event) use ($formModele) {
        //             // Entité Film (normalement)
              
        //             $data = $event->getData();
        //             // dd($data);
        //             //S'il y a des données, on appelle la méthode getModeles() sur l'entité Marque
        //             $data != null ? $marque = $data->getModeles() :  $marque = null;
        //             // if ($data != null) {
        //             //     $marque = $event->getData()->getModeles();
        //             // }else{
        //             //     $marque = null; 
        //             // }
                  
        //             // dd($data);
        //             //Closure. On injecte le formulaire et getModeles()
        //             $formModele($event->getForm(), $marque);
        //     }
        // );
    
        // $builder->get('marques')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function (FormEvent $event) use ($formModele) {
        //             //récupère les données du champ marques
        //             $marque = $event->getForm()->getData();
        //             // dd($marque);
        //             //Closure. Injection du formulaire parent les données du champ marques
        //             $formModele($event->getForm()->getParent(), $marque);
        //     }
        // );
    



            // ->add('modele', EntityType::class, [
            //     'label' => false,
            //     'class'         => Modele::class,
            //     'placeholder'   => 'Choisir un modele',
            //     'choice_label' => 'name',
            //     'required'      => false,
            //     'by_reference'  => false,
            //     'multiple'       => true,
            //     'auto_initialize'   => false,
            //     'expanded' => true
            //     ])

                

        // $builder->add('modele', ModeleType::class);
        // $builder->get('marques')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function(FormEvent $event){
        //         $form = $event->getForm();
        //         dd($form->getData());             
        //         $form->getParent()->add('modeles', EntityType::class, [
        //             'class'             => Modele::class,
        //             'placeholder'       => 'Sélectionnez le modèle',
        //             'mapped'            => false,
        //             'required'          => false,
        //             'auto_initialize'   => false,
        //             'choices'           => $form->getData()->getModeles(),
        //             'by_reference'  => false,
        //             'multiple' =>true
        //         ]);
           
                 
        //     }
        // );
        // dump($builder->getForm());
       
    

//     private function addCameraField(FormInterface $form, ?Marque $marque)
//     {
//         $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
//             'modeles',
//             EntityType::class,
//             null,
//             [
//                 'class'           => Modele::class,
//                 'placeholder'     => 'Sélectionnez un modele',
//                 // 'mapped'          => false,
//                 'required'        => false,
//                 'auto_initialize' => false,
//                 'choices'         => $marque ? $marque->getModeles() : [],
//                 'multiple'          =>true
//             ]
//         );
//         // $builder->addEventListener(
//         //     FormEvents::POST_SUBMIT,
//         //     function (FormEvent $event) {
//         //         $form = $event->getForm();
//         //         $this->addVilleField($form->getParent(), $form->getData());
//         //     }
//         // );
//         $form->add($builder->getForm());
    
// ;
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
