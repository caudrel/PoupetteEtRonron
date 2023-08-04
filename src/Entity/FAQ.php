<?php

namespace App\Entity;

use App\Repository\FAQRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FAQRepository::class)]
class FAQ
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Veuillez entrer une question')]
    #[Assert\Length(
        min: 10,
        max: 100,
        minMessage: 'La question doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le jour ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $question = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez entrer une réponse')]
    #[Assert\Length(
        min: 10,
        max: 250,
        minMessage: 'La réponse doit comporter au moins {{ limit }} caractères',
        maxMessage: 'La réponse ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $answer = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $isActiv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): static
    {
        $this->answer = $answer;

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
}
