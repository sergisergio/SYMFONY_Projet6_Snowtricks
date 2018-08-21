<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        /*for ($i = 1; $i <= 5; $i++) {
            $category = new Category();
            $category->setName('Catégorie-'.$i)
                ->setDescription('Diatrias tolerare tanquam noster caesium. Pellentesque vitae velit ex. Ubi est barbatus nix. Sunt seculaes transferre talis camerarius fluctuies. Bassus fatalis classiss virtualiter transferre de flavum. Sunt torquises imitari velox mirabilis medicinaes. Silva de secundus galatae demitto quadra. Ut eleifend mauris et risus ultrices egestas.')
                ->setSlug('category slug');
            $this->addReference('category-'.$i, $category);


            $manager->persist($category);
        }*/

        $cat1 = new Category();
        $cat1->setName('Flips');
        $cat1->setSlug('Flips');
        $cat1->setDescription('Flips');
        $manager->persist($cat1);

        $cat2 = new Category();
        $cat2->setName('Rotations');
        $cat2->setSlug('Rotations');
        $cat2->setDescription('Rotations');
        $manager->persist($cat2);

        $cat3 = new Category();
        $cat3->setName('Grabs');
        $cat3->setSlug('Grabs');
        $cat3->setDescription('Grabs');
        $manager->persist($cat3);

        $cat4 = new Category();
        $cat4->setName('Slides');
        $cat4->setSlug('Slides');
        $cat4->setDescription('Slides');
        $manager->persist($cat4);

        $cat5 = new Category();
        $cat5->setName('One Foot');
        $cat5->setSlug('One Foot');
        $cat5->setDescription('One Foot');
        $manager->persist($cat5);

        $cat6 = new Category();
        $cat6->setName('Old school');
        $cat6->setSlug('Old school');
        $cat6->setDescription('Old school');
        $manager->persist($cat6);

        $manager->flush();

        $this->addReference('cat1', $cat1);
        $this->addReference('cat2', $cat2);
        $this->addReference('cat3', $cat3);
        $this->addReference('cat4', $cat4);
        $this->addReference('cat5', $cat5);
        $this->addReference('cat6', $cat6);
    }
}
