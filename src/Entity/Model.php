<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vault $vault = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(length: 8192)]
    private ?string $pytorch_code = null;

    /**
     * @var Collection<int, Showcase>
     */
    #[ORM\ManyToMany(targetEntity: Showcase::class, mappedBy: 'models')]
    private Collection $showcases;

    #[ORM\Column(length: 255)]
    private ?string $imagePath = null;

    public function __construct()
    {
        $this->showcases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVault(): ?Vault
    {
        return $this->vault;
    }

    public function setVault(?Vault $vault): static
    {
        $this->vault = $vault;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPytorchCode(): ?string
    {
        return $this->pytorch_code;
    }

    public function setPytorchCode(string $pytorch_code): static
    {
        $this->pytorch_code = $pytorch_code;

        return $this;
    }

    /**
     * @return Collection<int, Showcase>
     */
    public function getShowcases(): Collection
    {
        return $this->showcases;
    }

    public function addShowcase(Showcase $showcase): static
    {
        if (!$this->showcases->contains($showcase)) {
            $this->showcases->add($showcase);
            $showcase->addModel($this);
        }

        return $this;
    }

    public function removeShowcase(Showcase $showcase): static
    {
        if ($this->showcases->removeElement($showcase)) {
            $showcase->removeModel($this);
        }

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}
