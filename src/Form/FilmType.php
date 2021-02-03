<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Marque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer le titre du film.']),
                ]])
            ->add('duree', IntegerType::class , [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir la durée du film.']),
                    ]
            ])
            ->add('synopsis', TextareaType::class, [
                'constraints'=> [
                    new NotBlank(['message' => 'Veuillez saisir le synopsis du film.']),
                    new Length([
                        'max' => 500,
                        'maxMessage' => 'Le synopsis doit comporter au maximum {{ limit }} caractères'
                    ])
            ]] )
            ->add('decade')
            ->add('sortie', ChoiceType::class, [
                'choices'       =>$this->getYears(1897),
                'placeholder'   => 'Choisir une année'
            ])
            ->add('marques', EntityType::class, [
                'class'         => Marque::class,
                'placeholder'   => 'Choisir une marque de caméra',
                'mapped'        => false,
                'required'        => false,
            ])
        ;
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
