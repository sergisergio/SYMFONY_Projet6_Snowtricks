<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Première façon de faire des fixtures à l'aide d'une boucle

        /*for ($i = 1; $i <= 5; $i++) {
            $category = new Category();
            $category->setName('Catégorie-'.$i)
                ->setDescription('Diatrias tolerare tanquam noster caesium. Pellentesque vitae velit ex. Ubi est barbatus nix. Sunt seculaes transferre talis camerarius fluctuies. Bassus fatalis classiss virtualiter transferre de flavum. Sunt torquises imitari velox mirabilis medicinaes. Silva de secundus galatae demitto quadra. Ut eleifend mauris et risus ultrices egestas.')
                ->setSlug('category slug');
            $this->addReference('category-'.$i, $category);
            $manager->persist($category);
        }
        $manager->flush();
        */


        // Deuxième façon: je crée des catégories manuellement un par un de façon à avoir un jeu de données
        // Ici, je crée 4 catégories : Flips, Rotations, Grabs et Slides.

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

        $manager->flush();

        // Une catégorie peut contenir plusieurs tricks donc j'ajoute une référence que je récupère dans Trick Fixtures

        $this->addReference('cat1', $cat1);
        $this->addReference('cat2', $cat2);
        $this->addReference('cat3', $cat3);
        $this->addReference('cat4', $cat4);
    }
    // Ici, je ne récupère pas de référence donc pas besoin de la méthode getDeoendencies
}
