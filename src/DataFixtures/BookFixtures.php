<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Book;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 9 ; $i++) { 
        	$book = new Book();
        	$book->setTitle("Livre n°$i")
        		 ->setAuthor("Auteur$i");

        		 $manager->persist($book);
        }

        $manager->flush();
    }
}
