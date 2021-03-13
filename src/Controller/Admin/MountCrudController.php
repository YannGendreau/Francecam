<?php

namespace App\Controller\Admin;

use App\Entity\Mount;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MountCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mount::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->HideOnForm(),
            TextField::new('name'),
            // TextEditorField::new('description'),
        ];
    }
    
}
