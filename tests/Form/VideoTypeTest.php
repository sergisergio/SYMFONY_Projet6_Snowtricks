<?php
/**
 * Created by PhpStorm.
 * User: patricia
 * Date: 16/09/2018
 * Time: 13:05
 */

namespace App\Tests\Form;


use App\Entity\Media;
use App\Entity\Trick;
use App\Form\VideoType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/*class VideoTypeTest extends TypeTestCase
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
            'url' => 'url',
            'trick' => new Trick(),
        );

        $objectToCompare = new Media();
        $form = $this->factory->create(VideoType::class, $objectToCompare);

        $object = new Media();
        $object->setUrl($formData['url']);
        $object->setTrick($formData['trick']);

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