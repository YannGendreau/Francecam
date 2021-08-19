<?php 

namespace App\Form;


use App\Entity\Genre;
use App\Entity\Camera;
use App\Entity\Marque;
use App\Data\FilmSearchData;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class SearchFilmForm extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            //BARRE DE RECHERCHE
            ->add ('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ]
            ])

            //FILTRE DE RECHERCHE
            ->add('genres', EntityType::class,[
                'label' => false,
                'required'=> false,
                'class' => Genre::class,
                'expanded'=> true,
                'multiple' => true,
                'query_builder'=> function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('g')
                    ->orderBy('g.name', 'ASC')
                    ;
                }
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
          
            ->add('marques', EntityType::class,[
                'label' => false,
                'required'=> false,
                'class' => Marque::class,
                'expanded'=> true,
                'multiple' => true,
                    
            ])
            // ->add('camera', EntityType::class,[
            //     'label' => false,
            //     'required'=> false,
            //     'class' => Camera::class,
            //     'expanded'=> true,
            //     'multiple' => true,
            //     'query_builder'     => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('c')
            //         ->select('c', 'ma', 'mo')
            //         ->leftJoin('c.marque', 'ma')
            //         ->leftJoin('c.modele', 'mo')
            //         ->orderBy('c.marque', 'ASC')
            //         ;
            //     }
                    
            // ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilmSearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}