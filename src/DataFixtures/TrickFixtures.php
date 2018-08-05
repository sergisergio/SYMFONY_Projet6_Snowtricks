<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Trick;

class TrickFixtures extends BaseFixture
{
    private static $trickName = [
        'Trick1', 'Trick2', 'Trick3', 'Trick4', 'Trick5',
    ];

    public function load(ObjectManager $manager)
    {
        $this->createMany(Trick::class, 15, function(Trick $trick, $count) {

            if ($this->faker->boolean(70)) {
                $trick->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }

            $trick->setName($this->faker->randomElement(self::$trickName));

        });
    }
}
