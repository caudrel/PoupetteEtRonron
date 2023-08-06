<?php

namespace App\Entity;

use App\Repository\OpeningHoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
class OpeningHours
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez entrer un jour')]
    #[Assert\Length(
        min: 3,
        max: 20,
        minMessage: 'Le jour doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le jour ne peut pas dépasser {{ limit }} caractères',
    )]
    private string $day;


    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez entrer une amplitude horaire')]
    #[Assert\Length(
        min: 5,
        max: 60,
        minMessage: "L'amplitude horaire doit comporter au moins {{ limit }} caractères",
        maxMessage: "L'amplitude horaire ne peut pas dépasser {{ limit }} caractères",
    )]
    private string $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

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
}
