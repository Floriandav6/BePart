<?php


namespace App\Controller\Admin;

use App\Entity\Blogpost;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BlogpostCrudController extends AbstractCrudController
{
    /* Controller lié à la section actualités de l'interface EasyAdmin */
    public static function getEntityFqcn(): string
    {
        return Blogpost::class;
    }

    /* Configurations des champs à afficher dans l'admin et dans les formulaires */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('file')->setBasePath('img/paints')->onlyOnIndex(),
            TextareaField::new('contenu'),
            DateField::new('createdAt')->hideOnForm(),
            SlugField::new('slug')->setTargetFieldName('titre')->hideOnIndex(),
        ];
    }
    /* Modification du design  */
public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPageTitle(Crud::PAGE_INDEX, 'Actualités')
            ->setPageTitle(Crud::PAGE_NEW, "Ajouter une actualité")
            ->setPageTitle(Crud::PAGE_EDIT, "Modifier une actualité");

    }

}

