<?php

namespace App\Entity;

use App\Repository\BonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BonRepository::class)
 */
class Bon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Reservering::class, inversedBy="bon", cascade={"persist", "remove"})
     */
    private $reserveringId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datumtijd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReserveringId(): ?Reservering
    {
        return $this->reserveringId;
    }

    public function setReserveringId(?Reservering $reserveringId): self
    {
        $this->reserveringId = $reserveringId;

        return $this;
    }

    public function getDatumtijd(): ?\DateTimeInterface
    {
        return $this->datumtijd;
    }

    public function setDatumtijd(\DateTimeInterface $datumtijd): self
    {
        $this->datumtijd = $datumtijd;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getId();
    }
}
