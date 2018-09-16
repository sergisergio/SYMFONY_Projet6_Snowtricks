<?php
/**
 * Created by PhpStorm.
 * User: patricia
 * Date: 16/09/2018
 * Time: 12:57
 */

namespace App\Tests\Form;


use App\Entity\Category;
use App\Entity\Trick;
use App\Form\AddTrickType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/*class AddTrickTypeTest extends TypeTestCase
{
    private $validator;

    protected function getExtensions()
    {
        $this->validator = $this->createMock(ValidatorInterface::class);
        // use getMock() on PHPUnit 5.3 or below
        // $this->validator = $this->getMock(ValidatorInterface::class);
        $this->validator
            ->method('validate')
            ->will($this->returnValue(new ConstraintViolationList()));
        $this->validator
            ->method('getMetadataFor')
            ->will($this->returnValue(new ClassMetadata(Form::class)));

        return array(
            new ValidatorExtension($this->validator),
        );
    }

    public function testSubmitValidData()
    {
        $formData = array(
            'name' => 'name',
            'description' => 'description',
            'category' => new Category(),
        );

        $objectToCompare = new Trick();
        $form = $this->factory->create(AddTrickType::class, $objectToCompare);

        $object = new Trick();
        $object->setCategory($formData['category']);
        $object->setName($formData['name']);
        $object->setDescription($formData['description']);

        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}*/