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
    public function testUsernameIsNull()
    {
        $this->assertNull($this->user->getUsername());
    }
    public function testPlainPasswordIsNull()
    {
        $this->assertNull($this->user->getPlainPassword());
    }
    public function testPlainPasswordIsNotNull()
    {
        $this->user->setPlainPassword('password');
        $this->assertNotNull($this->user->getPlainPassword());
    }
    public function testUsernameIsNotNull()
    {
        $this->user->setUsername('Philippe');
        $this->assertNotNull($this->user->getUsername());
    }
    public function testEmailIsNull()
    {
        $this->assertNull($this->user->getEmail());
    }
    public function testEmailIsNotNull()
    {
        $this->user->setEmail('toto@gmail.com');
        $this->assertNotNull($this->user->getEmail());
    }
    public function testPasswordIsNull()
    {
        $this->assertNull($this->user->getPassword());
    }
    public function testPasswordIsNotNull()
    {
        $this->user->setPassword('password');
        $this->assertNotNull($this->user->getPassword());
    }
    public function testTokenIsNull()
    {
        $this->assertNull($this->user->getToken());
    }
    public function testTokenIsNotNull()
    {
        $this->user->setToken('token');
        $this->assertNotNull($this->user->getToken());
    }
    public function testResetTokenIsNull()
    {
        $this->assertNull($this->user->getResetToken());
    }
    public function testResetTokenIsNotNull()
    {
        $this->user->setResetToken('token');
        $this->assertNotNull($this->user->getResetToken());
    }
    public function testRoleIsNull()
    {
        $this->assertNull($this->user->getRole());
    }
    public function testRoleIsNotNull()
    {
        $this->user->setRole('1');
        $this->assertNotNull($this->user->getRole());
    }
    public function testIsActiveIsNull()
    {
        $this->assertNull($this->user->getIsActive());
    }
    public function testIsActiveIsNotNull()
    {
        $this->user->setIsActive('1');
        $this->assertNotNull($this->user->getIsActive());
    }
    public function testAvatarIsNull()
    {
        $this->assertNull($this->user->getAvatar());
    }
    public function testAvatarIsNotNull()
    {
        $this->user->setAvatar('toto.jpg');
        $this->assertNotNull($this->user->getAvatar());
    }
}