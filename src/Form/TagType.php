<?php

namespace App\Form;

use App\Entity\Tag;
use App\Form\DataTransformer\TagsTransformer;
use App\Repository\TagRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagType extends AbstractType
{
    private $tagRepo;

    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepo=$tagRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->addModelTransformer(new CollectionToArrayTransformer(), true)
        ->addModelTransformer(new TagsTransformer($this->tagRepo), true);
    }

    public function getParent()
    {
        return TextType::class;
  
    }

}
