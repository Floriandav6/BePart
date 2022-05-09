<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    /* Controller lié à la section messages reçus de l'interface EasyAdmin */
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }
    /* Configurations des champs à afficher dans l'admin et dans les formulaires */
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('email'),
            TextareaField::new('message')


        ];
    }
    /* Modification des actions possibles sur cette section */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::DELETE, Action::NEW)
            ->disable(Action::EDIT, Action::NEW);

    }
    /* Modification du design  */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Messages')
            ->setPageTitle(Crud::PAGE_DETAIL,'Message reçu');

    }
}
