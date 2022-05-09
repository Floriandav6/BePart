<?php

namespace App\Controller\Admin;

use App\Entity\Blogpost;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategorieCrudController extends AbstractCrudController
{
    /* Controller lié à la section catégorie de l'interface EasyAdmin */
    public static function getEntityFqcn(): string
    {
        return Categorie::class;
    }

    /* Configurations des champs à afficher dans l'admin et dans les formulaires */
    public function configureFields(string $pageName): iterable
    {
        return [
           IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextareaField::new('description'),
            SlugField::new('slug')->setTargetFieldName('nom')->hideOnIndex(),

        ];
    }

    /* Modification du design  */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Catégories')
            ->setPageTitle(Crud::PAGE_NEW, "Ajouter une catégorie")
            ->setPageTitle(Crud::PAGE_EDIT, "Modifier une catégorie");

    }
}
