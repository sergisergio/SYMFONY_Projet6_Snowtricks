<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
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
        $manager->flush();*/
        $user1 = new User();
        $user1->setUsername('Philippe');
        $user1->setEmail('docsphilippe@gmail.com');
        $user1->setPassword(password_hash('philippe', PASSWORD_BCRYPT));
        $user1->setIsActive(true);
        $user1->setRole('1');
        //$user1->setRegisteredAt(new \DateTime());
        //$user1->setAvatar('johnAvatar.jpeg');
        $user1->setToken('blabla');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('Anonyme');
        $user2->setEmail('anonyme@gmail.com');
        $user2->setPassword(password_hash('anonyme', PASSWORD_BCRYPT));
        $user2->setIsActive(true);
        $user2->setRole('1');
        //$user2->setRegisteredAt(new \DateTime());
        //$user2->setAvatar('samAvatar.png');
        $user2->setToken('blabla');
        $manager->persist($user2);

        $manager->flush();

        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
    }
}
