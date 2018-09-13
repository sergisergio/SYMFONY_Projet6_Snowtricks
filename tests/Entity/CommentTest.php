<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 04/09/2018
 * Time: 23:32
 */

namespace App\Tests\Entity;


use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    private $comment;

    public function setUp()
    {
        $this->comment = new Comment();
        $this->trick = new Trick();
        $this->user = new User();
    }
    public function testCommentIsInstanceOfCommentClass()
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
    public function testSetTrickIsNotNull()
    {
        $this->comment->setTrick($this->trick);
        $this->assertNotNull($this->comment->getTrick());
    }
    public function testSetAuthorIsNotNull()
    {
        $this->comment->setAuthor($this->user);
        $this->assertNotNull($this->comment->getAuthor());
    }
}