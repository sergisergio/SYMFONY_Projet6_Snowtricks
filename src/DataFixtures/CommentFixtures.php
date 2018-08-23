<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Première façon de faire des fixtures à l'aide d'une boucle
        /*for ($i = 1; $i <= 5; $i++) {
            $comment = new Comment();
            $comment->setContent('Contenu Fixture-'.$i.'Diatrias tolerare tanquam noster caesium. Pellentesque vitae velit ex. Ubi est barbatus nix. Sunt seculaes transferre talis camerarius fluctuies. Bassus fatalis classiss virtualiter transferre de flavum. Sunt torquises imitari velox mirabilis medicinaes. Silva de secundus galatae demitto quadra. Ut eleifend mauris et risus ultrices egestas.')
                ->setCreatedAt(new \Datetime);

            $comment->setTrick($this->getReference('trick-1'));
            $comment->setAuthor($this->getReference('user-1'));

            $manager->persist($comment);
        }
        $manager->flush();
        */
        // Deuxième façon: je crée des commentaires manuellement un par un de façon à avoir un jeu de données
        // Ici, je crée 5 commentaires.
        $date = new \DateTime();

        $comment1 = new Comment();
        $comment1->setContent('Sympa ce trick !');
        $comment1->setCreatedAt($date);
        $comment1->setTrick($this->getReference('trick5'));
        $comment1->setAuthor($this->getReference('user2'));
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setContent('Trop cool ! ');
        $comment2->setCreatedAt($date);
        $comment2->setTrick($this->getReference('trick2'));
        $comment2->setAuthor($this->getReference('user1'));
        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3->setContent('Perso! Je me suis vautré à chaque fois que j\'ai essayé');
        $comment3->setCreatedAt($date->add(new \DateInterval('P1D')));
        $comment3->setTrick($this->getReference('trick3'));
        $comment3->setAuthor($this->getReference('user1'));
        $manager->persist($comment3);

        $comment4 = new Comment();
        $comment4->setContent('Cà donne envie d\'essayer !');
        $comment4->setCreatedAt($date->add(new \DateInterval('P2D')));
        $comment4->setTrick($this->getReference('trick3'));
        $comment4->setAuthor($this->getReference('user2'));
        $manager->persist($comment3);

        $comment5 = new Comment();
        $comment5->setContent('Magnifique !');
        $comment5->setCreatedAt($date->add(new \DateInterval('P4D')));
        $comment5->setTrick($this->getReference('trick3'));
        $comment5->setAuthor($this->getReference('user1'));
        $manager->persist($comment3);

        $manager->flush();
    }
    // Chaque commentaire correspond à un utilisateur et à un trick.
    // Je dois donc récupérer la référence du trick et celle de l'auteur pour chaque objet Comment
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [TrickFixtures::class, UserFixtures::class];
    }

}
