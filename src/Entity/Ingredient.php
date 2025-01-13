<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
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
    #[ORM\ManyToMany(targetEntity: Pizza::class, inversedBy: 'ingredients')]
    private Collection $tablejoin;

    public function __construct()
    {
        $this->tablejoin = new ArrayCollection();
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
    public function getTablejoin(): Collection
    {
        return $this->tablejoin;
    }

    public function addTablejoin(Pizza $tablejoin): static
    {
        if (!$this->tablejoin->contains($tablejoin)) {
            $this->tablejoin->add($tablejoin);
        }

        return $this;
    }

    public function removeTablejoin(Pizza $tablejoin): static
    {
        $this->tablejoin->removeElement($tablejoin);

        return $this;
    }
}
