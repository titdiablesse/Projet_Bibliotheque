<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $capability = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $equipments = null;

    #[ORM\Column]
    private ?bool $disponibility = null;

    #[ORM\Column]
    private ?\DateInterval $reservation_duration = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCapability(): ?int
    {
        return $this->capability;
    }

    public function setCapability(int $capability): static
    {
        $this->capability = $capability;

        return $this;
    }

    public function getEquipments(): ?string
    {
        return $this->equipments;
    }

    public function setEquipments(string $equipments): static
    {
        $this->equipments = $equipments;

        return $this;
    }

    public function isDisponibility(): ?bool
    {
        return $this->disponibility;
    }

    public function setDisponibility(bool $disponibility): static
    {
        $this->disponibility = $disponibility;

        return $this;
    }

    public function getReservationDuration(): ?\DateInterval
    {
        return $this->reservation_duration;
    }

    public function setReservationDuration(\DateInterval $reservation_duration): static
    {
        $this->reservation_duration = $reservation_duration;

        return $this;
    }
}
