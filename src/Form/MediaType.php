<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', FileType::class, array(
                'label' => 'Choisissez votre fichier',
                'constraints' => new File([
                    'maxSize' => '5M',
                    'mimeTypes' => [
                        'application/jpg',
                        'application/jpeg',
                        'application/png',
                    ],
                    'mimeTypesMessage' => 'Fichier JPG, JPEG ou PNG autorisés',
                ])
                )
            )
            ->add('trick', EntityType::class, [
                'placeholder' => 'Choisissez un trick',
                'class' => 'App\Entity\Trick',
                'choice_label' => 'name',
                'label' => 'Trick',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
