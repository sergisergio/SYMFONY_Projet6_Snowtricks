<?php
/**
 * Created by PhpStorm.
 * User: patricia
 * Date: 15/09/2018
 * Time: 16:52
 */

namespace App\Tests\Form;


use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\Form\Test\TypeTestCase;

class CategoryTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'name' => 'name',
        );

        $objectToCompare = new Category();

        $form = $this->factory->create(CategoryType::class, $objectToCompare);

        $object = new Category();
        $object->setName($formData['name']);

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