<?php
/**
 * Created by PhpStorm.
 * User: patricia
 * Date: 15/09/2018
 * Time: 16:43
 */

namespace App\Tests\Form;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Component\Form\Test\TypeTestCase;

class CommentTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'content' => 'content',
        );

        $objectToCompare = new Comment();

        $form = $this->factory->create(CommentType::class, $objectToCompare);

        $object = new Comment();
        $object->setContent($formData['content']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}