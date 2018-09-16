<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 04/09/2018
 * Time: 23:33
 */

namespace App\Tests\Entity;


use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Comment;
use App\Entity\Media;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
        $this->trick = new Trick();
        $this->comment = new Comment();
        $this->media = new Media();
    }
    public function testUserIsInstanceOfUserClass()
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
    public function testAddTrickIsOk()
    {
        $this->user->addTrick($this->trick);
        $this->assertCount(1, $this->user->getTricks());
    }
    public function testRemoveTrickIsOk()
    {
        $this->user->removeTrick($this->trick);
        $this->assertCount(0, $this->user->getTricks());
    }
    public function testAddCommentIsOk()
    {
        $this->user->addComment($this->comment);
        $this->assertCount(1, $this->user->getComments());
    }
    public function testRemoveCommentIsOk()
    {
        $this->user->removeComment($this->comment);
        $this->assertCount(0, $this->user->getComments());
    }
    public function testAddMediumIsOk()
    {
        $this->user->addMedium($this->media);
        $this->assertCount(1, $this->user->getMedia());
    }
    public function testRemoveMediumIsOk()
    {
        $this->user->removeMedium($this->media);
        $this->assertCount(0, $this->user->getMedia());
    }
    public function testRolesIsNotNull()
    {
        $this->assertSame(['ROLE_USER'], $this->user->getRoles());
    }
    public function testTricksIsOk()
    {
        $this->user->addTrick($this->trick);
        $this->assertCount(1, $this->user->getTricks());

        $this->user->removeTrick($this->trick);
        $this->assertCount(0, $this->user->getTricks());
    }
    public function testCommentsIsOk()
    {
        $this->user->addComment($this->comment);
        $this->assertCount(1, $this->user->getComments());

        $this->user->removeComment($this->comment);
        $this->assertCount(0, $this->user->getComments());
    }
    public function testMediaIsOk()
    {
        $this->user->addMedium($this->media);
        $this->assertCount(1, $this->user->getMedia());

        $this->user->removeMedium($this->media);
        $this->assertCount(0, $this->user->getMedia());
    }
}