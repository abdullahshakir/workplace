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
     * @ORM\Column(type="text")
     */
    private $summary;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=PostFile::class, mappedBy="post", orphanRemoval=true, cascade={"persist"})
     */
    private $postFiles;

    public function __construct()
    {
        $this->postFiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|PostFile[]
     */
    public function getPostFiles(): Collection
    {
        return $this->postFiles;
    }

    public function addPostFile(PostFile $postFile): self
    {
        if (!$this->postFiles->contains($postFile)) {
            $this->postFiles[] = $postFile;
            $postFile->setPost($this);
        }

        return $this;
    }

    public function removePostFile(PostFile $postFile): self
    {
        if ($this->postFiles->removeElement($postFile)) {
            // set the owning side to null (unless already changed)
            if ($postFile->getPost() === $this) {
                $postFile->setPost(null);
            }
        }

        return $this;
    }
}
