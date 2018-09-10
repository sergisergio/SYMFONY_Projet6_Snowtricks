<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 04/09/2018
 * Time: 23:32
 */

namespace App\Tests\Entity;


use App\Entity\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    private $comment;

    public function setUp()
    {
        $this->comment = new Comment();
    }
    public function testMediaIsInstanceOfCategoryClass()
    {
        $this->assertInstanceOf(Comment::class, $this->comment);
    }
    public function testIdIsNull()
    {
        $this->assertNull($this->comment->getId());
    }
    public function testContentIsNull()
    {
        $this->assertNull($this->comment->getContent());
    }
    public function testContentIsNotNull()
    {
        $this->comment->setContent('Contenu');
        $this->assertNotNull($this->comment->getContent());
    }
    public function testCreatedAt()
    {
        $this->comment->setCreatedAt(new \DateTime());
        $this->assertInstanceOf(\DateTime::class, $this->comment->getCreatedAt());
    }
    public function testUpdatedAt()
    {
        $this->comment->setUpdatedAt(new \DateTime());
        $this->assertInstanceOf(\DateTime::class, $this->comment->getUpdatedAt());
    }
}