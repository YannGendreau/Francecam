<?php

namespace App\Controller\Admin;

use App\Entity\Mount;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Mount2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mount::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
