<?php

namespace App\Controller\Admin;

use App\Entity\Modele;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ModeleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Modele::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->HideOnForm(),
            Field::new('imgFile')
                ->setFormType(VichImageType::class),
            ImageField::new('img')
                ->setBasePath('build/images/imagesCam')
                ->setUploadDir('/public/build/images/imagesCam/')
                ->hideOnForm(),
            TextField::new('image'),
            AssociationField::new('marque'),
            TextField::new('name'),
            IntegerField::new('sortie'),
            IntegerField::new('decade'),
            AssociationField::new('type'),
            AssociationField::new('format'),
            TextField::new('shutter'),
            // TextField::new('obt'),
            TextField::new('framerate'),
            AssociationField::new('mount'),
            IntegerField::new('noise'),
            TextField::new('perfs'),
            TextField::new('magazine'),
            TextField::new('voltage'),
            TextField::new('weight'),
            TextField::new('sync'),
            TextField::new('view'),
            TextField::new('slug'),
            TextareaField::new('description'),
           
        ];
    }
    
}
