<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Trick;

class TrickFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 5; $i++)
        {
            $trick = new Trick();
            $trick->setName('Name')
                ->setSlug('slug')
                ->setDescription('description')
                ->setCreatedAt(new \DateTime());

            $manager->persist($trick);
            $this->addReference('trick-'.$i, $trick);
            //dump($i);die();
        }
        $manager->flush();
    }
}
