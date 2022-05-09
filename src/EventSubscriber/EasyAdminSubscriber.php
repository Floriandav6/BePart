<?php

namespace App\EventSubscriber;

use App\Entity\Blogpost;
use App\Entity\Peinture;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;




class EasyAdminSubscriber implements EventSubscriberInterface
{

/* Ici j'ai crée les fonctions pour remplir automatiques les champs pour les dates et le user */

    private $slugger;
    private $security;

    public function __construct(Security $security)
    {

        $this->security =$security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class=> ['setDateAndUser'],
        ];

    }

    public function setDateAndUser( BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (($entity instanceof Blogpost)){

            $now = new DateTime('now');
            $entity->setCreatedAt($now);

            $user = $this->security->getUser();
            $entity->setUser($user);
        }
        if (($entity instanceof Peinture)){

            $now = new DateTime('now');
            $entity->setCreatedAt($now);

            $user = $this->security->getUser();
            $entity->setUser($user);
        }

        return;


    }

}
