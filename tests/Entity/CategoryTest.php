<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 04/09/2018
 * Time: 23:30
 */

namespace App\Tests\Entity;


use App\Entity\Category;
use App\Entity\Trick;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    private $category;

    public function setUp()
    {
        $this->category = new Category();
        $this->trick = new Trick();
    }
    public function testCategoryIsInstanceOfCategoryClass()
    {
        $this->assertInstanceOf(Category::class, $this->category);
    }
    public function testIdIsNull()
    {
        $this->assertNull($this->category->getId());
    }
    public function testNameIsOk()
    {
        $this->category->setName('Philippe');
        $this->assertSame('Philippe', $this->category->getName());
    }
    public function testSlugIsOk()
    {
        $this->category->setSlug('p-h-i-l-i-p-p-e');
        $this->assertSame('p-h-i-l-i-p-p-e', $this->category->getSlug());
    }
    public function testDescriptionIsOk()
    {
        $this->category->setDescription('une description lambda');
        $this->assertSame('une description lambda', $this->category->getDescription());
    }
    public function getTricksTest()
    {
        $this->category->getTricks([]);
        $this->assertSame([], $this->category->getTricks());
    }
    public function testTricksEmpty()
    {
        $this->assertCount(0, $this->category->getTricks());
    }
    public function testAddTrick()
    {
        $this->category->addTrick($this->trick);
        $this->assertCount(1, $this->category->getTricks());
    }
    public function testRemoveTrick()
    {
        $this->category->removeTrick($this->trick);
        $this->assertCount(0, $this->category->getTricks());
    }
    public function testTricksIsOk()
    {
        $this->category->addTrick($this->trick);
        $this->assertCount(1, $this->category->getTricks());

        $this->category->removeTrick($this->trick);
        $this->assertCount(0, $this->category->getTricks());
    }
}