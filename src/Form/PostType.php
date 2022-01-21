<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Title',
                    'class' => 'form-control mb-4'
                ]
            ])
            ->add('description', TextareaType::class, ['label' => false, 'attr' => [
                'placeholder' => 'Description',
                'class' => 'form-control mb-4 py-3'
            ]])
            ->add('tags', CollectionType::class, [
                'entry_type' => TagType::class,
                'label' => 'Tags',
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'entry_options' => [
                    'label' => false
                ]])

            ->add('photo', TextType::class, ['label' => false, 'attr' => [
                'placeholder' => 'Photo',
                'class' => 'form-control mb-4'
            ]]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
