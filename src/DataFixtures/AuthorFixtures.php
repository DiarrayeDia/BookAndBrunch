<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Authors;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AuthorsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($nbAuthors = 1; $nbAuthors < 10; $nbAuthors++) {
            $author = new Authors();
            $author->setFirstname($firstname);
            $author->setLastname($lastname);
            $author->setBiography($faker->text(500));
            $author->setPhoto($photo);
            $author->setCountry($country);
            $manager->persist($author);
        }
        $manager->flush();
    }
}
