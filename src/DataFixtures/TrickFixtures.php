<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Trick;

class TrickFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 20; $i++)
        {
            $trick = new Trick();
            $trick->setName('Name')
                ->setSlug('slug')
                ->setDescription('Ut suscipit posuere justo at vulputate. Aliquam sodales odio id eleifend tristique. Potus sensim ad ferox abnoba. Teres talis saepe tractare de camerarius flavum sensorem. Silva de secundus galatae demitto quadra.')
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());

            $manager->persist($trick);
            $this->addReference('trick-'.$i, $trick);
            //dump($i);die();
        }
        $manager->flush();
    }
}
