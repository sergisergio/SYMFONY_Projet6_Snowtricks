<?php

namespace App\DataFixtures;

use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 31; $i <= 35; $i++) {
            $media = new Media();
            $media->setUrl('https://image.redbull.com/rbcom/010/2015-04-15/1331717228402_2/0010/1/1500/1000/1/billy-morgan-lands-first-ever-snowboard-quad-cork.jpg')
                ->setType('i');

            $media->setTrick($this->getReference('trick-1'));
            $manager->persist($media);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [TrickFixtures::class];
    }
}
