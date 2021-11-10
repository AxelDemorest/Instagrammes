<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     */
    private $Picture;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="post")
     */
    private $Author;

    /**
     * @ORM\Column(type="integer")
     */
    private $Likes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Localisation;

    public function __construct()
    {
        $this->Author = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAuthor(): Collection
    {
        return $this->Author;
    }

    public function addAuthor(User $author): self
    {
        if (!$this->Author->contains($author)) {
            $this->Author[] = $author;
            $author->setPost($this);
        }

        return $this;
    }

    public function removeAuthor(User $author): self
    {
        if ($this->Author->removeElement($author)) {
            // set the owning side to null (unless already changed)
            if ($author->getPost() === $this) {
                $author->setPost(null);
            }
        }

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->Likes;
    }

    public function setLikes(int $Likes): self
    {
        $this->Likes = $Likes;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

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

    public function getLocalisation(): ?string
    {
        return $this->Localisation;
    }

    public function setLocalisation(?string $Localisation): self
    {
        $this->Localisation = $Localisation;

        return $this;
    }
}
