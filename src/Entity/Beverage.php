<?php

namespace App\Entity;

use App\Repository\BeverageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: BeverageRepository::class)]
class Beverage
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $beverageName = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isActiv = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'beverages')]
    private ?BeverageCategory $beverageCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeverageName(): ?string
    {
        return $this->beverageName;
    }

    public function setBeverageName(string $beverageName): static
    {
        $this->beverageName = $beverageName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    public function getBeverageCategory(): ?BeverageCategory
    {
        return $this->beverageCategory;
    }

    public function setBeverageCategory(?BeverageCategory $beverageCategory): static
    {
        $this->beverageCategory = $beverageCategory;

        return $this;
    }
}
