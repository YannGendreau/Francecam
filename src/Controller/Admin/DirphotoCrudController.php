<?php

namespace App\Controller\Admin;

use App\Entity\Dirphoto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DirphotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dirphoto::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            // TextEditorField::new('description'),
        ];
    }
    
}
