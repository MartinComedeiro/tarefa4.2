<?php

namespace App\Entity;

use App\Repository\CocheRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

#[ORM\Entity(repositoryClass: CocheRepository::class)]
class Coche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 1,
        max: 255,
        minMessage: 'Tu marca debe tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu marca no puede tener más de {{ limit }} caracteres')]
    private ?string $marca = null;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero(
        message: "Los km no puden ser negativos"
    )]
    private ?int $km = null;

    #[ORM\Column(nullable: true)]
    private ?bool $segundaMano = null;

    #[ORM\ManyToOne(inversedBy: 'coches')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(?string $marca): static
    {
        $this->marca = $marca;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(?int $km): static
    {
        $this->km = $km;

        return $this;
    }

    public function isSegundaMano(): ?bool
    {
        return $this->segundaMano;
    }

    public function setSegundaMano(?bool $segundaMano): static
    {
        $this->segundaMano = $segundaMano;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
