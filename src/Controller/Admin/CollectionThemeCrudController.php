<?php

namespace App\Controller\Admin;

use App\Entity\CollectionTheme;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CollectionThemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CollectionTheme::class;
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
