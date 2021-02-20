<?php

namespace App\Controller\Admin;

use App\Entity\Film;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FilmCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Film::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        

        $imageFile = Field::new('posterFile')
        ->setFormType(VichImageType::class);
        $image = ImageField::new('poster')
        ->setBasePath('build/images/posters')
        ->setUploadDir('/public/build/images/posters/')
        ->hideOnForm();
        

        $fields = [
            IdField::new('id')->HideOnForm(),
            
            TextField::new('title'),
            AssociationField::new('genres'),
            TextEditorField::new('synopsis'),
            IntegerField::new('duree'),
            IntegerField::new('sortie'),
            IntegerField::new('decade'),
            
            AssociationField::new('marques'),
            // AssociationField::new('camera'),

        ];

        if($pageName==Crud::PAGE_INDEX || $pageName==Crud::PAGE_DETAIL){
            $fields[] = $image;
        }else{
            $fields[] = $imageFile;
        }

        return $fields;
    //     $imageFile = ImageField::new('thumbnailFile')->setFormType(VichImageType::class);
    //     $image = ImageField::new('thumbnail')->setBasePath('/images/thumbnails');

    //     $fields = [
    //         IdField::new('id')->HideOnForm(),
    //         TextField::new('title'),
    //         AssociationField::new('genres'),
    //         TextEditorField::new('synopsis'),
    //     ];

    //     if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
    //         $fields[] = $image;
    //     } else {
    //         $fields[] = $imageFile;
    //     }
    //     return $fields;
        
    }
    
}
