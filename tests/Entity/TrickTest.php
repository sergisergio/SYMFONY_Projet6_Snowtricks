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
}