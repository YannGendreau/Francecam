<?php 

namespace App\Form;

use App\Entity\Camera;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Repository\FilmRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CameraFormType extends AbstractType
{
    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            // ->add('marques', EntityType::class,[
            //     'label' => false,
            //     'required'=> false,
            //     'class' => Marque::class,
            //     'expanded'=> true,
            //     'multiple' => true
            // ])
            // // ->add('modele', EntityType::class,[
            // //     'label' => false,
            // //     'required'=> false,
            // //     'class' => Modele::class,
            // //     'expanded'=> true,
            // //     'multiple' => true
            // // ])
            // ->add('modele', TextType::class, [
            //     'placeholder' => 'Un modele'
            // ])
            ->add('camera', CollectionType::class, [
                'entry_type' => MarqueType::class,
            ])

        ;
 

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Camera::class,
           
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}