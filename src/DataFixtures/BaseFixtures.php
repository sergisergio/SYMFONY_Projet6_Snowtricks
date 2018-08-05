<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

abstract class BaseFixture extends Fixture
{

  private $manager;
  /**
   * @var Generator
   */
  protected $faker;

  public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        //$this->loadData($manager);
        $this->faker = Factory::create();
    }

  abstract protected function loadData(ObjectManager $manager);
}
