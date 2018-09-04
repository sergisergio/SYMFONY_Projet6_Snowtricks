<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 04/09/2018
 * Time: 23:33
 */

namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
    }
    public function testMediaIsInstanceOfCategoryClass()
    {
        $this->assertInstanceOf(User::class, $this->user);
    }
    public function testIdIsNull()
    {
        $this->assertNull($this->user->getId());
    }
}