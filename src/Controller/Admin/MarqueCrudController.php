<?php

namespace App\Controller\Admin;

use App\Entity\Marque;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MarqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marque::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->HideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            AssociationField::new('modeles'),
            Field::new('logoFile')
                ->setFormType(VichImageType::class),
            ImageField::new('logoName')
                ->setBasePath('build/images/marques')
                ->setUploadDir('/public/build/images/marques/')
                ->hideOnForm(),
            TextField::new('website'),
        ];
    }
    
}
