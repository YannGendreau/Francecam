<?php

namespace App\Controller\Admin;

use App\Entity\Cameras;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CamerasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cameras::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->HideOnForm(),
            TextField::new('marque'),
            TextField::new('modele'),
            TextField::new('slug'),
            IntegerField::new('noise'),
            TextField::new('mount'),
            TextField::new('view'),
            IntegerField::new('voltage'),
            IntegerField::new('weight'),
            TextEditorField::new('description'),
        ];
    }
    
}
