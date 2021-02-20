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
    private $repository;

    public  function __construct(CameraRepository $repository)
    {
       return $this->repository = $repository;         
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
 
            ->add('marque', EntityType::class, [
                'label'         => false,
                'class'         => Marque::class,
                // 'choice_label'  => 'name',
                'placeholder'   => 'Choisir la marque',
                'mapped'        => true,
                'required'      => false,
                'by_reference'  => false,
                'multiple'      => true,
                // 'expanded'      => true,
                
            ])
        ;
         $builder->get('marque')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event){
                $form = $event->getForm();
              $data= $form->getData();
            //   dd($data);
                $form->getParent()->add('modele', EntityType::class, [
                    'class'             => Modele::class,
                    'placeholder'       => 'Sélectionnez le modèle',
                    // 'choice_label'      => 'name',
                    'mapped'            => false,
                    'required'          => false,
                    'auto_initialize'   => false,
                    // 'choices'           => $form->getData(),
                    // 'choices'           => $this->repository->findAll(),
                    'by_reference'  => false,
                ]);
                 
            }
        );
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
