<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 04/09/2018
 * Time: 18:57
 */

namespace App\Tests\Entity;

use App\Entity\Media;
use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class MediaTest extends TestCase
{
    private $media;

    public function setUp()
    {
        $this->media = new Media();
        $this->trick = new Trick();
        $this->user = new User();
    }
    public function testIdIsNull()
    {
        $this->assertNull($this->media->getId());
    }
    public function testMediaIsInstanceOfMediaClass()
    {
        $this->assertInstanceOf(Media::class, $this->media);
    }
    public function testUrlIsNotNull()
    {
        $this->media->setUrl('https://www.glisshop.com/gfx/graphic/glisshop/navs/fn_freeride.jpg');
        $this->assertNotNull($this->media->getUrl());
    }
    public function testTypeIsNotNull()
    {
        $this->media->setType('i');
        $this->assertNotNull($this->media->getType());
    }
    public function testTrickIsNotNull()
    {
        $this->media->setTrick($this->trick);
        $this->assertNotNull($this->media->getTrick());
    }
    public function testUserIsNotNull()
    {
        $this->media->setUser($this->user);
        $this->assertNotNull($this->media->getUser());
    }
}