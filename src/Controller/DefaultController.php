<?php
namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Commentaire;
use App\Entity\Contact;
use App\Form\CommentaireType;
use App\Form\ContactType;
use App\Form\SearchForm;
use App\Repository\BlogpostRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommentaireRepository;
use App\Repository\PeintureRepository;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Service\CommentaireService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Migrations\Configuration\EntityManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;


class DefaultController extends AbstractController


{

    public function __construct(private EntityManagerInterface $em)
    {

    }
    /* Création de la route de l'index avec récupération des différents tables dynamiques et filtres*/
    /**
     * @Route("/", name="home")
     */
    public function home( BlogpostRepository $blogpostRepository, CategorieRepository $categorieRepository ,PeintureRepository $peintureRepository, Request $request): Response
    {

       /* $filters = $request->get("cats"); */

        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $peintures = $peintureRepository->findSearch($data);

        $categories = $categorieRepository->findAll();

        $blogposts = $blogpostRepository->lastFive();



          return $this->render('pages/index.html.twig', [
              'peintures' => $peintures,
              'categories' => $categories,
              'blogposts' => $blogposts,
              'form' => $form->createView(),
          ]);


    }

    /* Création de la route contact et son formulaire*/
/**
 * @Route("/contact", name="contact")
 */

    public function index( Request $request, EntityManagerInterface $em):Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();
            $em->persist($data);
            $em->flush();
            $this->addFlash('success', 'Message envoyé avec succès!');

        }


        return $this->render('pages/contact.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /* Route pour les singles projects avec la récupération du  formulaire et l'affichage des commentaires */
    /**
     * @Route("/single-paint/{id}", name="peinture")
     */

    public function peinture (int $id, PeintureRepository $peintureRepository,CommentaireService $commentaireService, CommentaireRepository $commentaireRepository, Request  $request, EntityManagerInterface $em): Response {

        $peinture = $peintureRepository->find($id);
        $commentaires = $commentaireRepository->findCommentaires($peinture);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();
            $commentaireService->persistCommentaire($commentaire, $peinture);



            return $this->redirectToRoute('peinture',['id' => $peinture->getId()] );
        }
        return $this->render('pages/peinture.html.twig',
            [   'peinture'      => $peinture,
                'form'          =>$form->createView(),
                'commentaires'  => $commentaires
            ]);

    }
    }

