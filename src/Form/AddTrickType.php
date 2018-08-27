<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Trick;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\CategoryType;

class AddTrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du trick',
            ])
            ->add('description')
            ->add('category', EntityType::class, [
                'placeholder' => 'Choisissez une catégorie',
                'class' => 'App\Entity\Category',
                'choice_label' => 'name',
                'label' => 'Catégorie',
            ])
                    // Comment faire ici car je dois utiliser EntityType et FileType...
                    // Dans le traitement, cette donnée devra être de type 'i'
            //->add('media', FileType::class, array('label' => 'Image (fichier jpg)'))

            // Ici même problème, la donnée devra être de type 'v'
            /*->add('media', EntityType::class, [
                'label' => 'Lien vidéo (youtube ou dailymotion)',
                'class' => 'App\Entity\Media',
                'choice_label' => 'url',
            ])*/
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
