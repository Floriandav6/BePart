<?php


namespace App\Service;

use App\Entity\Peinture;
use App\Entity\Commentaire;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


class CommentaireService
{
    /* création d'un service pour la persistence des commentaires lorsque l'admin coche la case 'isPublished' */
    private $manager;
    private $flash;


    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flash)
    {
        $this->manager = $manager;
        $this->flash = $flash;
    }

    public function  persistCommentaire (

        Commentaire $commentaire,
        Peinture $peinture

    ): void {

        $commentaire->setIsPublished(false)
                    ->setPeinture($peinture)
                    ->SetCreatedAt(new DateTime('now'));

        $this->manager->persist($commentaire);
        $this->manager->flush();
        $this->flash->add('success', 'Votre commentaire a bien été envoyé, il sera publié après validation !');



}

}
