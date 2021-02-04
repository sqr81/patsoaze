<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $categorie1 = new Categorie();
        $categorie1->setNom("exposition");
        $manager->persist($categorie1);

        $categorie2 = new Categorie();
        $categorie2->setNom("photo");
        $manager->persist($categorie2);

        $categorie3 = new Categorie();
        $categorie3->setNom("aquarelle");
        $manager->persist($categorie3);

        $manager->flush();
    }

}