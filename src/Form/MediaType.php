<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('url')
            ->add('url', FileType::class, array(
                'label' => 'Choisissez votre fichier'
                    )
            )
            //->add('type')
            ->add('trick', EntityType::class, [
                'placeholder' => 'Choisissez un trick',
                'class' => 'App\Entity\Trick',
                'choice_label' => 'name',
                'label' => 'Trick',
            ])
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
