<?php
/**
 * Created by PhpStorm.
 * User: patricia
 * Date: 16/09/2018
 * Time: 13:39
 */

namespace App\Tests\Repository;


use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrickRepositoryTest extends KernelTestCase
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

    public function testAllVideo()
    {
        $trick = $this->entityManager
            ->getRepository(Trick::class)
            ->findAll()
        ;

        $this->assertNotNull($trick);
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