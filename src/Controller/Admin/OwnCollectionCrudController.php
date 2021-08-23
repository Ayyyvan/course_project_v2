<?php

namespace App\Controller\Admin;

use App\Entity\OwnCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OwnCollectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OwnCollection::class;
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
