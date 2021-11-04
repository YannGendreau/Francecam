<?php

namespace App\Controller\Admin;

use App\Entity\Modele;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ModeleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Modele::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
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
            TextField::new('image')->HideOnIndex(),
            AssociationField::new('marque'),
            TextField::new('name'),
            TextEditorField::new('description')->setFormType(CKEditorType::class),
            IntegerField::new('sortie'),
            IntegerField::new('decade')->hideOnIndex(),
            AssociationField::new('type'),
            AssociationField::new('format'),
            TextField::new('shutter'),
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
          
            // TextareaField::new('description'),

           
        ];
    }
    
}
