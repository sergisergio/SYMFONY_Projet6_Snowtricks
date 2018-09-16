<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 04/09/2018
 * Time: 23:33
 */

namespace App\Tests\Entity;


use App\Entity\Trick;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Media;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
    private $trick;

    public function setUp()
    {
        $this->trick = new Trick();
        $this->comment = new Comment();
        $this->user = new User();
        $this->media = new Media();
        $this->category = new Category();
    }
    public function testTrickIsInstanceOfTrickClass()
    {
        $this->assertInstanceOf(Trick::class, $this->trick);
    }
    public function testIdIsNull()
    {
        $this->assertNull($this->trick->getId());
    }
    public function testNameIsNull()
    {
        $this->assertNull($this->trick->getName());
    }
    public function testNameIsNotNull()
    {
        $this->trick->setName('Name');
        $this->assertNotNull($this->trick->getName());
    }
    public function testSlugIsNull()
    {
        $this->assertNull($this->trick->getSlug());
    }
    public function testSlugIsNotNull()
    {
        $this->trick->setSlug('Slug');
        $this->assertNotNull($this->trick->getSlug());
    }
    public function testDescriptionIsNull()
    {
        $this->assertNull($this->trick->getDescription());
    }
    public function testDescriptionIsNotNull()
    {
        $this->trick->setDescription('Description');
        $this->assertNotNull($this->trick->getDescription());
    }
    public function testCreatedAt()
    {
        $this->trick->setCreatedAt(new \DateTime());
        $this->assertInstanceOf(\DateTime::class, $this->trick->getCreatedAt());
    }
    public function testUpdatedAt()
    {
        $this->trick->setUpdatedAt(new \DateTime());
        $this->assertInstanceOf(\DateTime::class, $this->trick->getUpdatedAt());
    }
    public function testAddCommentIsOk()
    {
        $this->trick->addComment($this->comment);
        $this->assertCount(1, $this->trick->getComments());
    }
    public function testRemoveCommentIsOk()
    {
        $this->trick->removeComment($this->comment);
        $this->assertCount(0, $this->trick->getComments());
    }
    public function testAddMediumIsOk()
    {
        $this->trick->addMedium($this->media);
        $this->assertCount(1, $this->trick->getMedia());
    }
    public function testRemoveMediumIsOk()
    {
        $this->trick->removeMedium($this->media);
        $this->assertCount(0, $this->trick->getMedia());
    }
    public function testAuthorIsOk()
    {
        $this->trick->setAuthor($this->user);
        $this->assertNotNull($this->trick->getAuthor());
    }
    public function testCategoryIsOk()
    {
        $this->trick->setCategory($this->category);
        $this->assertNotNull($this->trick->getCategory());
    }
    public function testCommentsIsOk()
    {
        $this->trick->addComment($this->comment);
        $this->assertCount(1, $this->trick->getComments());

        $this->trick->removeComment($this->comment);
        $this->assertCount(0, $this->trick->getComments());
    }
    public function testMediaIsOk()
    {
        $this->trick->addMedium($this->media);
        $this->assertCount(1, $this->trick->getMedia());

        $this->trick->removeMedium($this->media);
        $this->assertCount(0, $this->trick->getMedia());
    }
}