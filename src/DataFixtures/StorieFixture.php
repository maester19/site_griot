<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Storie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class StorieFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i =0; $i < 20; $i++){
            $storie = new Storie();
            $storie ->setTitre($faker->words(3, true))
                    ->setSynopsie($faker->sentences(3, true))
                    ->setType(new Categorie)
                    ->setAuteur(new Auteur)
                    ->setCreatedAt(new \datetime);
            $manager->persist($storie);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
