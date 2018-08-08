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
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 5; $i++) {
            $comment = new Comment();
            $comment->setContent('Diatrias tolerare tanquam noster caesium. Pellentesque vitae velit ex. Ubi est barbatus nix. Sunt seculaes transferre talis camerarius fluctuies. Bassus fatalis classiss virtualiter transferre de flavum. Sunt torquises imitari velox mirabilis medicinaes. Silva de secundus galatae demitto quadra. Ut eleifend mauris et risus ultrices egestas.')
                ->setCreatedAt(new \Datetime);

            $comment->setTrick($this->getReference('trick-1'));

            $manager->persist($comment);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [TrickFixtures::class];
    }

}
