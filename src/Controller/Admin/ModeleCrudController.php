<?php

namespace App\Controller\Admin;

use App\Entity\Modele;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
            AssociationField::new('marque'),
            TextField::new('name'),
            AssociationField::new('format'),
            AssociationField::new('shutter'),
            AssociationField::new('mount'),
            IntegerField::new('sortie'),
            IntegerField::new('decade'),
            TextField::new('slug'),
            TextEditorField::new('description'),
           
        ];
    }
    
}
