<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentaireCrudController extends AbstractCrudController
{
    /* Controller lié à la section commentaire de l'interface EasyAdmin */
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    } public function configureFields(string $pageName): iterable
{
    return [

        /* Configurations des champs à afficher dans l'admin et dans les formulaires */
        AssociationField::new('peinture'),
        TextField::new('auteur'),
        EmailField::new('email')->onlyOnForms(),
        DateTimeField::new('createdAt'),
        TextareaField::new('contenu'),
        BooleanField::new('isPublished')


    ];
}
    /* Modification des actions possibles sur cette section */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);



    }
    /* Modification du design  */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPageTitle(Crud::PAGE_INDEX, 'Commentaires')
            ->setPageTitle(Crud::PAGE_EDIT, "Modifier un commentaire");

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
