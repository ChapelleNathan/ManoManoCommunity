<?php


namespace App\Form\DataTransformer;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Symfony\Component\Form\DataTransformerInterface;

class TagsTransformer implements DataTransformerInterface
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository=$tagRepository;
    }

    public function transform($value)
    {
        return implode(',', $value);
    }

    public function reverseTransform($string)
    {
        $names = explode(',', $string);

        $tags = $this->tagRepository->findBy(['name'=> $names]);

        $newNames =array_diff($names, $tags);
        foreach ($newNames as $name) {
            $tag = new Tag();
            $tag->setName($name);
            $tags[] = $tag;
        }

        return $tags;
        
    }
}