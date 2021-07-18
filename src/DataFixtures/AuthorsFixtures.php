<?php

namespace App\DataFixtures;

use App\Entity\Authors;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AuthorsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $author = new Authors();
        $faker = Factory::create('fr_FR');
        for ($nbAuthors = 1; $nbAuthors < 10; $nbAuthors++) {

            $author->setFirstname($faker->firstName());
            $author->setLastname($faker->lastName());
            $author->setBiography($faker->text(500));
            $author->setPhoto($faker->image());
            $author->setCountry($faker->country());
            //$author->setSlug($faker->slug);
            $manager->persist($author);
        }
        $manager->flush();
    }
}
