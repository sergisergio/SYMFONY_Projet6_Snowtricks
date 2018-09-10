<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 04/09/2018
 * Time: 23:33
 */

namespace App\Tests\Entity;


use App\Entity\Trick;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
    private $trick;

    public function setUp()
    {
        $this->trick = new Trick();
    }
    public function testMediaIsInstanceOfCategoryClass()
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
}