<?php

namespace App\Controller\Admin;

use App\Entity\Shutter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ShutterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shutter::class;
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
