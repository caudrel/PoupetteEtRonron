<?php

namespace App\Entity;

use App\Repository\ContactSubjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ContactSubjectRepository::class)]
class ContactSubject
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(
        message: 'Le sujet de contact est obligatoire',
    )]
    #[Assert\Length(
        min: 5,
        max: 60,
        minMessage: 'Le sujet de contact doit comporter au moins {{ limit }} caractères.',
        maxMessage: 'Le sujet de contact ne peut pas dépasser {{ limit }} caractères.',
    )]
    private ?string $subject = null;

    #[ORM\Column]
    private ?bool $isValid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): static
    {
        $this->isValid = $isValid;

        return $this;
    }
}
