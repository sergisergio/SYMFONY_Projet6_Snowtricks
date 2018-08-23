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
        /*for ($i = 1; $i <= 5; $i++) {
            $media = new Media();
            $media->setUrl('')
                ->setType('i');

            $media->setTrick($this->getReference(''));
            $manager->persist($media);
            $this->addReference('media-'.$i, $media);
        }*/
        //$manager->flush();
        $image1 = new Media();
        $image1->setUrl('frontflip.jpg');
        $image1->setType('i');
        $image1->setTrick($this->getReference('trick1'));
        $manager->persist($image1);

        $image2 = new Media();
        $image2->setUrl('backflip.jpg');
        $image2->setType('i');
        $image2->setTrick($this->getReference('trick2'));
        $manager->persist($image2);



        $image3 = new Media();
        $image3->setUrl('truckDriver.jpg');
        $image3->setType('i');
        $image3->setTrick($this->getReference('trick3'));
        $manager->persist($image3);

        $image4 = new Media();
        $image4->setUrl('360.jpg');
        $image4->setType('i');
        $image4->setTrick($this->getReference('trick4'));
        $manager->persist($image4);

        $image5 = new Media();
        $image5->setUrl('720.jpg');
        $image5->setType('i');
        $image5->setTrick($this->getReference('trick5'));
        $manager->persist($image5);

        $image6 = new Media();
        $image6->setUrl('1080.jpg');
        $image6->setType('i');
        $image6->setTrick($this->getReference('trick6'));
        $manager->persist($image6);

        $image7 = new Media();
        $image7->setUrl('indy.jpg');
        $image7->setType('i');
        $image7->setTrick($this->getReference('trick7'));
        $manager->persist($image7);

        $image8 = new Media();
        $image8->setUrl('sad.jpg');
        $image8->setType('i');
        $image8->setTrick($this->getReference('trick8'));
        $manager->persist($image8);



        $image9 = new Media();
        $image9->setUrl('noseslide.jpg');
        $image9->setType('i');
        $image9->setTrick($this->getReference('trick9'));
        $manager->persist($image9);

        $image10 = new Media();
        $image10->setUrl('tailslide.jpg');
        $image10->setType('i');
        $image10->setTrick($this->getReference('trick10'));
        $manager->persist($image10);

        $manager->flush();
    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [TrickFixtures::class];
    }
}
