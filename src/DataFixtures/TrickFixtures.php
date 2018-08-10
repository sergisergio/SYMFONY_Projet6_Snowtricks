<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Trick;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 30; $i++)
        {
            $trick = new Trick();
            $trick->setName('Name-'.$i)
                ->setSlug('slug')
                ->setDescription('Description'.$i.'Ut suscipit posuere justo at vulputate. Aliquam sodales odio id eleifend tristique. Potus sensim ad ferox abnoba. Teres talis saepe tractare de camerarius flavum sensorem. Silva de secundus galatae demitto quadra.')
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());

            $manager->persist($trick);
            $this->addReference('trick-'.$i, $trick);
            $trick->setCategory($this->getReference('category-1'));
            $trick->setAuthor($this->getReference('user-1'));

            //dump($i);die();
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [CategoryFixtures::class, UserFixtures::class];
    }


}
