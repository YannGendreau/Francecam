<?php 

namespace App\Form;


use App\Entity\Format;
use App\Entity\Marque;
use App\Data\CameraSearchData;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class SearchCameraForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add ('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ]

            ])
            ->add('format', EntityType::class,[
                'label' => false,
                'required'=> false,
                'class' => Format::class,
                'expanded'=> true,
                'multiple' => true,
                'query_builder'  => function (EntityRepository $er ){
                    return $er->createQueryBuilder('m')
                    ->orderBy('m.name', 'ASC')
                    ;
                }
            ])

            ->add('marque', EntityType::class,[
                'label' => false,
                'required'=> false,
                'class' => Marque::class,
                'expanded'=> true,
                'multiple' => true
            ])
       
          
            ->add('decade', ChoiceType::class, [
 
                'label' => false,
           
                'choices' => [
                    '1910' => '1910',
                    '1920' => '1920',
                    '1930' => '1930',
                    '1940' => '1940',
                    '1950' => '1950',
                    '1960' => '1960',
                    '1970' => '1970',
                    '1980' => '1980',
                    '1990' => '1990',
                    
                ],
             
                'expanded' => true,
                'multiple' => true,
               
            ])
           
            ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CameraSearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}