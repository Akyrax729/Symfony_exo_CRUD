<?php

namespace App\Entity;

use App\Repository\PateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PateRepository::class)]
class Pate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, Pizza>
     */
    #[ORM\OneToMany(targetEntity: Pizza::class, mappedBy: 'type_pate')]
    private Collection $pate;

    public function __construct()
    {
        $this->pate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPate(): Collection
    {
        return $this->pate;
    }

    public function addPate(Pizza $pate): static
    {
        if (!$this->pate->contains($pate)) {
            $this->pate->add($pate);
            $pate->setTypePate($this);
        }

        return $this;
    }

    public function removePate(Pizza $pate): static
    {
        if ($this->pate->removeElement($pate)) {
            // set the owning side to null (unless already changed)
            if ($pate->getTypePate() === $this) {
                $pate->setTypePate(null);
            }
        }

        return $this;
    }
}
