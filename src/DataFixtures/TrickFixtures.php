<?php

namespace App\DataFixtures;


use App\Entity\Category;
use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Trick;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Première façon de faire des fixtures à l'aide d'une boucle

        /*for ($i = 1; $i <= 30; $i++)
        {
            $trick = new Trick();
            $trick->setName('Name-'.$i)
                ->setSlug('slug')
                ->setDescription('Description'.$i.'Ut suscipit posuere justo at vulputate. Aliquam sodales odio id eleifend tristique. Potus sensim ad ferox abnoba. Teres talis saepe tractare de camerarius flavum sensorem. Silva de secundus galatae demitto quadra.')
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->addMedium('https://www.washingtonpost.com/resizer/fgPobGKqI2jhyI84CwdRUsrmSDg=/480x0/arc-anglerfish-washpost-prod-washpost.s3.amazonaws.com/public/4D4D3UAXOEI6RCYIAJ5GZSZY5M.jpg');

            $manager->persist($trick);
            $this->addReference('trick-'.$i, $trick);
            $trick->setCategory($this->getReference('category-'.rand(1, 5)));
            $trick->setAuthor($this->getReference('user-'.rand(1,5)));
        }
        $manager->flush();
        */

        // Deuxième façon: je crée des tricks manuellement un par un de façon à avoir un jeu de données
        // 10 Tricks seront créés

        $date = new \DateTime();

        $trick1 = new Trick();
        $trick1->setDescription('Rotation verticale avant');
        $trick1->setCreatedAt($date->add(new \DateInterval('P6DT2H9M')));
        $trick1->setSlug('front-flip');
        $trick1->setUpdatedAt($date->add(new \DateInterval('P12DT12H')));
        $trick1->setCategory($this->getReference('cat1'));
        $trick1->setAuthor($this->getReference('user2'));
        $trick1->setName('Front flip');
        $manager->persist($trick1);

        $trick2 = new Trick();
        $trick2->setDescription('Rotation verticale arrière');
        $trick2->setCreatedAt($date->add(new \DateInterval('P3DT3H')));
        $trick2->setSlug('back-flip');
        $trick2->setCategory($this->getReference('cat1'));
        $trick2->setAuthor($this->getReference('user2'));
        $trick2->setName('Back flip');
        $manager->persist($trick2);

        $trick3 = new Trick();
        $trick3->setDescription(
            'Saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)'
        );
        $trick3->setCreatedAt($date->add(new \DateInterval('P1D')));
        $trick3->setSlug('truck-driver');
        $trick3->setCategory($this->getReference('cat1'));
        $trick3->setAuthor($this->getReference('user1'));
        $trick3->setName('truck driver');
        $manager->persist($trick3);

        $trick4 = new Trick();
        $trick4->setDescription(
            'Un tour complet en effectuant une rotation horizontale pendant le saut'
        );
        $trick4->setCreatedAt($date->add(new \DateInterval('P2W')));
        $trick4->setSlug('360');
        $trick4->setCategory($this->getReference('cat2'));
        $trick4->setAuthor($this->getReference('user1'));
        $trick4->setName('360');
        $manager->persist($trick4);

        $trick5 = new Trick();
        $trick5->setDescription(
            'Deux tours complets en effectuant une rotation horizontale pendant le saut'
        );
        $trick5->setCreatedAt($date->add(new \DateInterval('P1Y1D')));
        $trick5->setSlug('720');
        $trick5->setCategory($this->getReference('cat2'));
        $trick5->setAuthor($this->getReference('user1'));
        $trick5->setName('720');
        $manager->persist($trick5);

        $trick6 = new Trick();
        $trick6->setDescription(
            'Trois tours complets en effectuant une rotation horizontale pendant le saut'
        );
        $trick6->setCreatedAt($date->add(new \DateInterval('P1DT12H')));
        $trick6->setSlug('1080');
        $trick6->setCategory($this->getReference('cat2'));
        $trick6->setAuthor($this->getReference('user2'));
        $trick6->setName('1080');
        $manager->persist($trick6);

        $trick7 = new Trick();
        $trick7->setDescription('Saisie de la carre frontside de la planche entre les deux pieds avec la main avant');
        $trick7->setCreatedAt($date);
        $trick7->setSlug('mute');
        $trick7->setCategory($this->getReference('cat3'));
        $trick7->setAuthor($this->getReference('user1'));
        $trick7->setName('mute');
        $manager->persist($trick7);

        $trick8 = new Trick();
        $trick8->setDescription(
            'saisie de la carre backside de la planche entre les deux pieds avec la main arrière'
        );
        $trick8->setCreatedAt($date->add(new \DateInterval('P2D')));
        $trick8->setSlug('stalefish');
        $trick8->setCategory($this->getReference('cat3'));
        $trick8->setAuthor($this->getReference('user1'));
        $trick8->setName('stalefish');
        $manager->persist($trick8);

        $trick9 = new Trick();
        $trick9->setDescription('Glisser sur une barre de slide avec l\'avant de la planche');
        $trick9->setCreatedAt($date->add(new \DateInterval('P10DT6H')));
        $trick9->setSlug('nose-slide');
        $trick9->setCategory($this->getReference('cat4'));
        $trick9->setAuthor($this->getReference('user2'));
        $trick9->setName('nose slide');
        $manager->persist($trick9);

        $trick10 = new Trick();
        $trick10->setDescription('Glisser sur une barre de slide avec l\'arrière de la planche');
        $trick10->setCreatedAt($date->add(new \DateInterval('P1W')));
        $trick10->setSlug('tail-slide');
        $trick10->setUpdatedAt($date->add(new \DateInterval('P2D')));
        $trick10->setCategory($this->getReference('cat4'));
        $trick10->setAuthor($this->getReference('user2'));
        $trick10->setName('tail slide');
        $manager->persist($trick10);

        // J'ajoute encore 10 tricks avec une boucle pour tester le load more
        for ($i = 11; $i <= 20; $i++)
        {
            $trick = new Trick();
            $trick->setName('Name-'.$i)
                ->setSlug('Name-'.$i)
                ->setDescription('Description'.$i.'Ut suscipit posuere justo at vulputate. Aliquam sodales odio id eleifend tristique. Potus sensim ad ferox abnoba. Teres talis saepe tractare de camerarius flavum sensorem. Silva de secundus galatae demitto quadra.')
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setCategory($this->getReference('cat4'))
                ->setAuthor($this->getReference('user2'));


            $manager->persist($trick);
            $this->addReference('trick-'.$i, $trick);
        }

        $manager->flush();

        // Chaque article peut avoir des commentaires donc je dois ajouter une référence
        $this->addReference('trick1', $trick1);
        $this->addReference('trick2', $trick2);
        $this->addReference('trick3', $trick3);
        $this->addReference('trick4', $trick4);
        $this->addReference('trick5', $trick5);
        $this->addReference('trick6', $trick6);
        $this->addReference('trick7', $trick7);
        $this->addReference('trick8', $trick8);
        $this->addReference('trick9', $trick9);
        $this->addReference('trick10', $trick10);
    }

    // Aussi, chaque article a un auteur et une catégorie: je dois donc récupérer la référence des deux.
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [CategoryFixtures::class, UserFixtures::class];
    }


}
