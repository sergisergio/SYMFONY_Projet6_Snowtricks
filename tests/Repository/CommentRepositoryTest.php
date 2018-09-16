<?php
/**
 * Created by PhpStorm.
 * User: patricia
 * Date: 16/09/2018
 * Time: 13:34
 */

namespace App\Tests\Repository;


use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentRepositoryTest extends KernelTestCase
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

    public function testAllComments()
    {
        $comments = $this->entityManager
            ->getRepository(Comment::class)
            ->findAll()
        ;

        $this->assertNotNull($comments);
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