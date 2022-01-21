<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private ?string $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private ?string $photo;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $owner;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="posts", cascade={"persist"})
     * @Assert\Count(max = 5)
     * @Assert\Valid
     */
    private ?Collection $Tags;
  
     /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="favorites")
     */
    private $starred;

    public function __construct()
    {
        $this->Tags = new ArrayCollection();
        $this->starred = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->Tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->Tags->contains($tag)) {
            $this->Tags[] = $tag;
        }
      
        return $this;
    }
  
    /**
     * @return Collection|User[]
     */
    public function getStarred(): Collection
    {
        return $this->starred;
    }

    public function addToStarred(User $starred): self
    {
        if (!$this->starred->contains($starred)) {
            $this->starred[] = $starred;
            $starred->addToFavorite($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->Tags->removeElement($tag);
      
      return $this;
    }

    public function removeFromStarred(User $starred): self
    {
        if ($this->starred->removeElement($starred)) {
            $starred->removeFromFavorite($this);
        }

        return $this;
    }
}
