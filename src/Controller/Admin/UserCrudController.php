<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    /* Controller lié à la section mon compte de l'interface EasyAdmin */
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    /* Configurations des champs à afficher dans l'admin et dans les formulaires */
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('email'),
            ArrayField::new('roles')->hideOnForm()



        ];
    }
    /* Modification des actions possibles sur cette section */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::DELETE, Action::NEW);



    }
    /* Modification du design  */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Mon profil')
            ->setPageTitle(Crud::PAGE_DETAIL,'Mes infos');

    }


}
