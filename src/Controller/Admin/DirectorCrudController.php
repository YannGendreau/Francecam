<?php

namespace App\Controller\Admin;

use App\Entity\Director;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DirectorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Director::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideonform(),
            TextField::new('Name'),
        ];
    }
    
}
