<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Trick;

class TrickFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $trick = new Trick();
        $trick->setName('Page pour ajouter un trick')
            ->setSlug('nom d\'un trick'.rand(100, 999))
            ->setDescription('DESCRIPTIONNNNNNNNN')
            ->setCreatedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));

        $manager->persist($trick);
        $manager->flush();
    }
}
