<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Pizza = null;

    #[ORM\Column(length: 255)]
    private ?string $Ingredient_secret = null;

    #[ORM\ManyToOne(inversedBy: 'pate')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pate $type_pate = null;

    /**
     * @var Collection<int, Ingredient>
     */
    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'pizzas')]
    private Collection $ingredient;

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPizza(): ?string
    {
        return $this->Pizza;
    }

    public function setPizza(string $Pizza): static
    {
        $this->Pizza = $Pizza;

        return $this;
    }

    public function getIngredientSecret(): ?string
    {
        return $this->Ingredient_secret;
    }

    public function setIngredientSecret(string $Ingredient_secret): static
    {
        $this->Ingredient_secret = $Ingredient_secret;

        return $this;
    }

    public function getTypePate(): ?Pate
    {
        return $this->type_pate;
    }

    public function setTypePate(?Pate $type_pate): static
    {
        $this->type_pate = $type_pate;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient->add($ingredient);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        $this->ingredient->removeElement($ingredient);

        return $this;
    }

}
