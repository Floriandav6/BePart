<?php

namespace App\Controller\Admin;

use App\Entity\Peinture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PeintureCrudController extends AbstractCrudController
{
    /* Controller lié à la section peintures de l'interface EasyAdmin */
    public static function getEntityFqcn(): string
    {
        return Peinture::class;
    }

    /* Configurations des champs à afficher dans l'admin et dans les formulaires */
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            AssociationField::new('categorie')->hideOnIndex(),
            TextareaField::new('description'),
            DateField::new('dateRealisation'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('file')->setBasePath('img/paints')->onlyOnIndex(),
            NumberField::new('largeur')->hideOnIndex(),
            NumberField::new('hauteur')->hideOnIndex(),
            NumberField::new('prix'),
            BooleanField::new('vente')->hideOnIndex(),
            SlugField::new('slug')->setTargetFieldName('nom')->hideOnIndex(),

        ];
    }
    /* Modification du design  */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPageTitle(Crud::PAGE_INDEX, 'Peintures')
            ->setPageTitle(Crud::PAGE_NEW, "Ajouter une peinture")
            ->setPageTitle(Crud::PAGE_EDIT, "Modifier une peinture");

    }

}
