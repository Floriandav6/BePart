<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Categorie;
use App\Entity\Peinture;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /* C'est ici que j'ai crée les fixtures pour avoir une base à mon projet et pouvoir manipuler les données dynamiques*/
    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager ): void
    {

        $faker = Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('floriandav7@gmail.com')
            ->setPrenom($faker->firstName())
            ->setNom($faker->lastName());

        $user->setPassword("test123");
        /*     $user->setPassword(
                $this->userPasswordHasherInterface->hashPassword(
                    $user, "test123"
                )*/


        $manager->persist($user);

        for ($i=0; $i < 4; $i++){
            $blogpost = new Blogpost();
            $blogpost->setTitre($faker->words(3,true))
                     ->setCreatedAt($faker->dateTimeBetween('-1 month', 'now'))
                     ->setContenu($faker->text(150))
                     ->setSlug($faker->slug(3))
                     ->setUser($user)
                     ->setFile('img/quote-1.jpg');

                     $manager->persist($blogpost);
        }
        for ($k=0; $k < 4; $k++) {
            $categorie = new Categorie();
            $categorie->setSlug($faker->slug(3))
                      ->setDescription($faker->words(10,true))
                      ->setNom($faker->word);

            $manager->persist($categorie);

            for ($j=0; $j < 2; $j++)  {
                $peinture = new Peinture();
                $peinture ->setNom($faker->words(3,true))
                          ->setCreatedAt($faker->dateTimeBetween('-1 month', 'now'))
                          ->setDateRealisation($faker->dateTimeBetween('-1 month', 'now'))
                          ->setLargeur($faker->randomFloat(2,20,60))
                          ->setHauteur($faker->randomFloat(2,20,60))
                          ->setVente($faker->randomElement([true, false]))
                          ->setPrix($faker->randomFloat(2,100,9999))
                          ->setUser($user)
                          ->setFile('/img/paints/abstract-1.jpg')
                          ->setDescription($faker->words(10,true))
                          ->addCategorie($categorie)
                          ->setSlug($faker->slug(3));

                    $manager->persist($peinture);

            }

        }


        $manager->flush();
    }
}
