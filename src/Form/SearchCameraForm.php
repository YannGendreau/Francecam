<?php 

namespace App\Form;


use App\Form\YEAR;
use App\Entity\Film;
use App\Entity\Genre;

use App\Entity\Marque;
// use Symfony\Bridge\Doctrine\Form\Type\ChoiceType;
use App\Entity\Modele;
use App\Entity\CameraType;
use App\Data\FilmSearchData;
use App\Data\CameraSearchData;
use App\Repository\FilmRepository;
use App\Repository\ModeleRepository;
use PhpParser\Node\Expr\AssignOp\Concat;
use Symfony\Component\Form\AbstractType;
use DoctrineExtensions\Query\Mysql\Round;
use DoctrineExtensions\Query\Mysql\ConcatWs;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class SearchCameraForm extends AbstractType
{
    private $modeleRepository;

    public function __construct(ModeleRepository $modeleRepository)
    {
        $this->modeleRepository = $modeleRepository;
    }


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
                    '1930' => '1930',
                    '1940' => '1940',
                    '1950' => '1950',
                    '1960' => '1960',
                    '1970' => '1970',
                    '1980' => '1980',
                    '1990' => '1990',
                    '2000' => '2000',
                    '2010' => '2010',
                    '2020' => '2020'
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