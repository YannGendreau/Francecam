<?php 

namespace App\Form;


use App\Form\YEAR;
use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Data\FilmSearchData;
use App\Data\SearchHomeData;
use App\Repository\FilmRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class SearchHomeType extends AbstractType
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      
        
        $builder
            //BARRE DE RECHERCHE
            ->add ('r', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchHomeData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}