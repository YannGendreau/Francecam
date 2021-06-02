<?php

namespace App\Controller\Admin;

use App\Entity\Camera;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CameraCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Camera::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('marque'),
            AssociationField::new('modele'),
            TextField::new('slug'),
            // TextEditorField::new('description'),
        ];
    }
    
}
