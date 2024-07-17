<?php

namespace App\Entity;

use App\Repository\MovieHasPeopleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieHasPeopleRepository::class)]
class MovieHasPeople
{
    public const SIGNIFICANCE_PRINCIPAL = 'principal';
    public const SIGNIFICANCE_SECONDAIRE = 'secondaire';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $significance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getSignificance(): ?string
    {
        return $this->significance;
    }

    public function setSignificance(?string $significance): self
    {
        if (!in_array($significance, [self::SIGNIFICANCE_PRINCIPAL, self::SIGNIFICANCE_SECONDAIRE])) {
            throw new \InvalidArgumentException("Invalid significance");
        }
        $this->significance = $significance;

        return $this;
    }
}
