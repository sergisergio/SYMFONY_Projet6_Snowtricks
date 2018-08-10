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
        for ($i = 1; $i <= 5; $i++) {
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
    }
}
