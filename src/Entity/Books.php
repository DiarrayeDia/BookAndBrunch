<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BooksRepository::class)
 */
class Books
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
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $translation;

    /**
     * @ORM\ManyToMany(targetEntity=Authors::class, inversedBy="books", cascade={"persist"})
     * @ORM\JoinTable(name="books_authors")
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="book")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity=Bookshelf::class, inversedBy="books")
     */
    private $bookshelf;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getTranslation(): ?bool
    {
        return $this->translation;
    }

    public function setTranslation(?bool $translation): self
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * @return Collection|Authors[]
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Authors $author): self
    {
        if (!$this->author->contains($author)) {
            $this->author[] = $author;
        }

        return $this;
    }

    public function removeAuthor(Authors $author): self
    {
        $this->author->removeElement($author);

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setBook($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getBook() === $this) {
                $comment->setBook(null);
            }
        }

        return $this;
    }

    public function getBookshelf(): ?Bookshelf
    {
        return $this->bookshelf;
    }

    public function setBookshelf(?Bookshelf $bookshelf): self
    {
        $this->bookshelf = $bookshelf;

        return $this;
    }
}
