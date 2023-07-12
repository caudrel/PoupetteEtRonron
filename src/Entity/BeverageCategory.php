<?php

namespace App\Entity;

use App\Repository\BeverageCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: BeverageCategoryRepository::class)]
class BeverageCategory
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 35)]
    private ?string $beverageCategoryName = null;

    #[ORM\Column]
    private ?bool $isActiv = null;

    #[ORM\OneToMany(mappedBy: 'beverageCategory', targetEntity: Beverage::class)]
    private Collection $beverages;

    public function __construct()
    {
        $this->beverages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeverageCategoryName(): ?string
    {
        return $this->beverageCategoryName;
    }

    public function setBeverageCategoryName(string $beverageCategoryName): static
    {
        $this->beverageCategoryName = $beverageCategoryName;

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
     * @return Collection<int, Beverage>
     */
    public function getBeverages(): Collection
    {
        return $this->beverages;
    }

    public function addBeverage(Beverage $beverage): static
    {
        if (!$this->beverages->contains($beverage)) {
            $this->beverages->add($beverage);
            $beverage->setBeverageCategory($this);
        }

        return $this;
    }

    public function removeBeverage(Beverage $beverage): static
    {
        if ($this->beverages->removeElement($beverage)) {
            // set the owning side to null (unless already changed)
            if ($beverage->getBeverageCategory() === $this) {
                $beverage->setBeverageCategory(null);
            }
        }

        return $this;
    }
}
