<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Tag;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        // On configure dans quelles langues nous voulons nos données
        $faker = \Faker\Factory::create('fr_FR');

        // on créé 10 personnes
        for ($i = 0; $i < 10; $i++) {
            $tag = new Tag();
            $tag->setNom($faker->name);
            $manager->persist($tag);
        }

        $manager->flush();

    }



}
