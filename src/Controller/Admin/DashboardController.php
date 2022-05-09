<?php

namespace App\Controller\Admin;

use App\Entity\Blogpost;
use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\Contact;
use App\Entity\Peinture;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/bo', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(PeintureCrudController::class)->generateUrl();

        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }
    /* Modification du design  */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()

            ->setTitle('<img src="img/logo-admin.png"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;BE PART <span class="text-small"> OF ART</span>');
    }
    /* Création de la navigation de l'interface EasyAdmin */
    public function configureMenuItems(): iterable

    {
        yield MenuItem::linktoRoute('Retour au site', 'fas fa-home', 'home');
        yield MenuItem::linkToCrud('Peintures', 'fas fa-palette', Peinture::class);
        yield MenuItem::linkToCrud('Actualités', 'fas fa-newspaper', Blogpost::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comments', Commentaire::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Messages', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Mon compte', 'fas fa-users', User::class);

    }

}
