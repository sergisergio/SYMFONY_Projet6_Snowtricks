<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Première façon de faire des fixtures à l'aide d'une boucle

        /*for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setUsername('Utilisateur-'.$i)
                ->setPassword('XXXXXXXX-'.$i)
                ->setEmail('email@email.com'.$i)
                ->setToken('tokentokentoken'.$i)
                ->setRole(1)
                ->setIsActive(1);
            $manager->persist($user);
            $this->addReference('user-' . $i, $user);
        }
        $manager->flush();
        */

        // Deuxième façon: je crée des utilisateurs manuellement un par un de façon à avoir un jeu de données
        // Je crée 2 utilisateurs

        $user1 = new User();
        $user1->setUsername('Philippe');
        $user1->setEmail('docsphilippe@gmail.com');
        $user1->setPassword(password_hash('philippe', PASSWORD_BCRYPT));
        $user1->setIsActive(true);
        $user1->setRole('1');
        $user1->setToken('blabla');
        $user1->setAvatar('avatar1.jpg');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('Anonyme');
        $user2->setEmail('anonyme@gmail.com');
        $user2->setPassword(password_hash('anonyme', PASSWORD_BCRYPT));
        $user2->setIsActive(true);
        $user2->setRole('1');
        $user2->setToken('blabla');
        $user1->setAvatar('avatar1.jpg');
        $manager->persist($user2);

        $manager->flush();

        // Chaque utilisateur peut ajouter un trick ou un commentaire: je dois donc ajouter une référence
        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
    }
}