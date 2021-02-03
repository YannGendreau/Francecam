<?php 

namespace App\Form;


use App\Form\YEAR;
use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Marque;
use App\Entity\Modele;
// use Symfony\Bridge\Doctrine\Form\Type\ChoiceType;
use App\Data\FilmSearchData;
use App\Repository\FilmRepository;
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

class SearchFilmForm extends AbstractType
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
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
            // ->add('genres', EntityType::class,[
            //     'label' => false,
            //     'required'=> false,
            //     'class' => Genre::class,
            //     'expanded'=> true,
            //     'multiple' => true
            // ])


            // ->add('annee', EntityType::class,[
            //     'label' => false,
            //     'required'=> false,
            //     'class' => Film::class,
            //     'expanded'=> true,
            //     'multiple' => true,
            //     // 'choices' => function (FilmRepository $er) {
            //     //     return $er->groupByDecadeSql();
            //     //     // return $er->createQueryBuilder('s')
            //     //     // ->select('s.sortie')
            //     //     // ;
            //     // }
            //     // 'query_builder' => function (FilmRepository $er) {
            //     //     return $er->groupByDecadeSqlDeux();
            //     //     // return $er->createQueryBuilder('s')
            //     //     // ->select('s.sortie')
            //     //     // ;
            //     // }
            //     ])


            // ->add('annee', ChoiceType::class, [
            //     // 'choice_value'=> '[decade]',
            //     // 'mapped' => false,
            //     'label' => false,
            //     'choices' => $this->filmRepository->groupByDecadeSql(),
            //     'choice_label' => function($choice, $key, $value){
            //         return $value;
            //     },
            //     'expanded' => true,
            //     'multiple' => true,
               
            // ])
            ->add('decade', ChoiceType::class, [
                // 'choice_value'=> '[decade]',
                // 'mapped' => false,
                'label' => false,
                // 'choices' => $this->filmRepository->groupByDecadeSql(),
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
                // 'choice_label' => function($choice, $key, $value){
                //     return $value;
                // },
                'expanded' => true,
                'multiple' => true,
               
            ])
            // ->add('decade', EntityType::class,[
            //     'label' => false,
            //     'required'=> false,
            //     'class' => Film::class,
            //     'expanded'=> true,
            //     'multiple' => true,
            // ])
            // ->add('decade', EntityType::class,[
            //     'label' => false,
            //     'required'=> false,
            //     'class' => Film::class,
            //     'expanded'=> true,
            //     'multiple' => true,
            //     'query_builder' => function(FilmRepository $er){
            //         return $er->createQueryBuilder('c')
            //         ->orderBy('c.decade', 'ASC');
            //     }
            // ])
            

            
            ->add('marques', EntityType::class,[
                'label' => false,
                'required'=> false,
                'class' => Marque::class,
                'expanded'=> true,
                'multiple' => true,
            ])
            ;
// dump($builder);
                               
                            // ->select('a.annee')
                // //             ->addSelect('ROUND(s.sortie)')
                // //             // return $er->groupByDecadeSql()
                // //             // ->select('YEAR(s.sortie)')
                // //     //         // ->distinct()
                // //     // //         ->orderBy('decennie', 'ASC');
                // //     // // //     // ->select('s.sortie as sortie')
                // //     // // //     // ->select('DISTINCT s.sortie')
                // //     // // //     ->select($er->groupByDecadeSql($sortie))
                        // ->addSelect("CONCAT(SUBSTRING(s.sortie, 1, 3), '0') as decennie")
                // //     // // //     // ->where('s.sortie IN (:sortie)')

  // 'builder' => $builder->getData()->getSortie(),
                // 'choices' =>$this->filmRepository->groupByDecade()
                // 'group_by' => function (Film $film){
                //     return $film->dateToString();
                //     // $sortie = $film->getSortie()->format('Y');
                //     // return strval($sortie);
                // }



            // ->select("distinct concat('s.sortie', 1, 0)) as (:date)")
                        // ->select("
                        //     DISTINCT UPPER(
                        //     CONCAT(SUBSTRING(s.sortie, 1, 3), '0')
                        //     )")
                        // ->addSelect('(SELECT DISTINCT CONCAT(SUBSTRING(s.sortie, 1,3), \'0\'))')
                        // ->addSelect('CONCAT(date, \'0\') AS decennie')
                        // ->orderBy('s.sortie', 'ASC');
                        // ->where('s.sortie = ?1')
                        // ->orderBy('asc'); 

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