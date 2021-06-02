<?php

namespace App\Controller\Admin;

use App\Entity\Film;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
            TextField::new('image'),
            TextField::new('videolink'),
            AssociationField::new('genres'),
            AssociationField::new('pays'),
            AssociationField::new('directors'),
            AssociationField::new('dirphoto'),
            TextareaField::new('synopsis'),
            IntegerField::new('duree'),
            IntegerField::new('sortie'),
            IntegerField::new('decade'),
            AssociationField::new('camera'),
            AssociationField::new('marques'),
            AssociationField::new('modeles'),
            // AssociationField::new('camera'),
            DateTimeField::new('createdAt')->HideOnForm(),
            DateTimeField::new('updatedAt')->HideOnForm(),
            AssociationField::new('user'),

        ];

        if($pageName==Crud::PAGE_INDEX || $pageName==Crud::PAGE_DETAIL){
            $fields[] = $image;
        }else{
            $fields[] = $imageFile;
        }

        return $fields;
        
    }
    
}
