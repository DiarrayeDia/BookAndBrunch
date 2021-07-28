<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($nbBooks = 1; $nbBooks < 6; $nbBooks++) {
            $book = new Book();
            $book->setTitle($faker->realText(25));
            $book->setYear($faker->year);
            $book->setSummary($faker->text(500));
            /*             $book->setSlug($faker->slug);
            $book->setCover($faker->image('public/clean/assets/covers')); */
            $manager->persist($book);
        }
        $manager->flush();
    }
}
