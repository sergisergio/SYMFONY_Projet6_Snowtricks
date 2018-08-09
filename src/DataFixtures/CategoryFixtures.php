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
        for ($i = 1; $i <= 5; $i++) {
            $category = new Category();
            $category->setName('Catégorie')
                ->setDescription('Diatrias tolerare tanquam noster caesium. Pellentesque vitae velit ex. Ubi est barbatus nix. Sunt seculaes transferre talis camerarius fluctuies. Bassus fatalis classiss virtualiter transferre de flavum. Sunt torquises imitari velox mirabilis medicinaes. Silva de secundus galatae demitto quadra. Ut eleifend mauris et risus ultrices egestas.')
                ->setSlug('category slug');
            $this->addReference('category-'.$i, $category);


            $manager->persist($category);
        }
        $manager->flush();
    }
}
