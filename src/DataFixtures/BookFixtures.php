<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Books;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BooksFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($nbBooks = 1; $nbBooks < 6; $nbBooks++) {
            $book = new Books();
            $book->setTitle($faker->realText(25));
            $book->setYear($year);
            $book->setSummary($faker->text(500));
            $book->setPhoto($photo);
            $book->setSlug($faker->slug);
            $book->setCover($faker->image('public/clean/assets/covers'));
            $book->addAuthor($author);
            $manager->persist($book);
        }
        $manager->flush();
    }
}
