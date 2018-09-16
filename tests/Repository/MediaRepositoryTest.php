<?php
/**
 * Created by PhpStorm.
 * User: patricia
 * Date: 16/09/2018
 * Time: 13:38
 */

namespace App\Tests\Repository;


use App\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MediaRepositoryTest extends KernelTestCase
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

    public function testAllMedia()
    {
        $media = $this->entityManager
            ->getRepository(Media::class)
            ->findAll()
        ;

        $this->assertNotNull($media);
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