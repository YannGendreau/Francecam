<?php

namespace App\Controller\Admin;

use App\Entity\Format;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Format::class;
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
