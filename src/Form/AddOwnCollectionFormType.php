<?php

namespace App\Form;

use App\Entity\CollectionTheme;
use App\Entity\OwnCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddOwnCollectionFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'collection.name'
            ])

            ->add('collectionTheme', EntityType::class, [
                'class' => CollectionTheme::class,
                'choice_label' => 'name',
                'label' => 'collection.theme',
            ])

            ->add('description', TextareaType::class, [
                'label' => 'collection.description'
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'collection.submit'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OwnCollection::class,
        ]);
    }
}
