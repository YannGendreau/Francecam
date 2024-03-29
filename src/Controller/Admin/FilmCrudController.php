<?php

namespace App\Controller\Admin;

use App\Entity\Film;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FilmCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Film::class;
    }

        public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    
    public function configureFields(string $pageName): iterable
    {
        

        $imageFile = Field::new('posterFile')
        ->setFormType(VichImageType::class)
        ->setLabel('Affiche')
        ;
        $image = ImageField::new('poster')
        ->setBasePath('build/images/posters')
        ->setUploadDir('/public/build/images/posters/')
        
        ;
        

        $fields = [
            IdField::new('id')->HideOnForm(),
            TextField::new('title'),
            BooleanField::new('isVerified'),
            TextField::new('image')->hideOnIndex(),
            TextField::new('videolink')->hideOnIndex(),
            AssociationField::new('genres'),
            AssociationField::new('pays'),
            AssociationField::new('directors'),
            AssociationField::new('dirphoto'),
            TextEditorField::new('synopsis')->setFormType(CKEditorType::class),
            // TextareaField::new('synopsis'),
            IntegerField::new('duree'),
            IntegerField::new('sortie'),
            IntegerField::new('decade')->hideOnIndex(),
            AssociationField::new('camera'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->HideOnForm(),
            AssociationField::new('user'),

        ];

        if($pageName===Crud::PAGE_INDEX || $pageName===Crud::PAGE_DETAIL){
            $fields[] = $image;
        }else{
            $fields[] = $imageFile;
        }

        return $fields;
        
    }

    
    
}
