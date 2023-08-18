<?php

namespace App\Entity;

use App\Repository\FoodCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FoodCategoryRepository::class)]
class FoodCategory
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le nom de la catégorie ne peut pas être vide')]
    #[Assert\Length(
        min: 3,
        max: 35,
        minMessage: 'Le nom de la catégorie doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le nom de la catégorie ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $foodCategoryName = null;

    #[ORM\Column]
    private ?bool $isActiv = null;

    #[ORM\OneToMany(mappedBy: 'foodCategory', targetEntity: Food::class)]
    private Collection $food;

    public function __construct()
    {
        $this->food = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoodCategoryName(): ?string
    {
        return $this->foodCategoryName;
    }

    public function setFoodCategoryName(string $foodCategoryName): static
    {
        $this->foodCategoryName = $foodCategoryName;

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

    /**
     * @return Collection<int, Food>
     */
    public function getFood(): Collection
    {
        return $this->food;
    }

    public function addFood(Food $food): static
    {
        if (!$this->food->contains($food)) {
            $this->food->add($food);
            $food->setFoodCategory($this);
        }

        return $this;
    }

    public function removeFood(Food $food): static
    {
        if ($this->food->removeElement($food)) {
            // set the owning side to null (unless already changed)
            if ($food->getFoodCategory() === $this) {
                $food->setFoodCategory(null);
            }
        }

        return $this;
    }
}
