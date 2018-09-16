<?php
/**
 * Created by PhpStorm.
 * User: patricia
 * Date: 16/09/2018
 * Time: 13:36
 */

namespace App\Tests\Repository;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testAllUsers()
    {
        $users = $this->entityManager
            ->getRepository(User::class)
            ->findAll()
        ;

        $this->assertNotNull($users);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}