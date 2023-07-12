<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: FoodRepository::class)]
class Food
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $foodName = null;

    #[ORM\Column(length: 200)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isVegetarian = null;

    #[ORM\Column]
    private ?bool $isActiv = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'food')]
    private ?FoodCategory $foodCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoodName(): ?string
    {
        return $this->foodName;
    }

    public function setFoodName(string $foodName): static
    {
        $this->foodName = $foodName;

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

    public function isIsVegetarian(): ?bool
    {
        return $this->isVegetarian;
    }

    public function setIsVegetarian(?bool $isVegetarian): static
    {
        $this->isVegetarian = $isVegetarian;

        return $this;
    }

    public function isIsActiv(): ?bool
    {
        return $this->isActiv;
    }

    public function setIsActiv(bool $isActiv): static
    {
        $this->isActiv = $isActiv;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getFoodCategory(): ?FoodCategory
    {
        return $this->foodCategory;
    }

    public function setFoodCategory(?FoodCategory $foodCategory): static
    {
        $this->foodCategory = $foodCategory;

        return $this;
    }
}
