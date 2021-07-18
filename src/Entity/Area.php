<?php

namespace App\Entity;

use App\Repository\AreaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AreaRepository::class)
 */
class Area
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Area::class, inversedBy="areas")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Area::class, mappedBy="parent")
     */
    private $areas;

    /**
     * @ORM\ManyToMany(targetEntity=Books::class, inversedBy="areas")
     */
    private $books;

    public function __construct()
    {
        $this->areas = new ArrayCollection();
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAreas(): Collection
    {
        return $this->areas;
    }

    public function addArea(self $area): self
    {
        if (!$this->areas->contains($area)) {
            $this->areas[] = $area;
            $area->setParent($this);
        }

        return $this;
    }

    public function removeArea(self $area): self
    {
        if ($this->areas->removeElement($area)) {
            // set the owning side to null (unless already changed)
            if ($area->getParent() === $this) {
                $area->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Books[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Books $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
        }

        return $this;
    }

    public function removeBook(Books $book): self
    {
        $this->books->removeElement($book);

        return $this;
    }
}
