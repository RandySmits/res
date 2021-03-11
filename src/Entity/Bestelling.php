<?php

namespace App\Entity;

use App\Repository\BestellingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BestellingRepository::class)
 */
class Bestelling
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Menuitem::class, inversedBy="bestellings")
     */
    private $menuitemId;

    /**
     * @ORM\ManyToOne(targetEntity=Reservering::class, inversedBy="bestellings")
     */
    private $reserveringId;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $klaar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuitemId(): ?Menuitem
    {
        return $this->menuitemId;
    }

    public function setMenuitemId(?Menuitem $menuitemId): self
    {
        $this->menuitemId = $menuitemId;

        return $this;
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

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getKlaar(): ?bool
    {
        return $this->klaar;
    }

    public function setKlaar(bool $klaar): self
    {
        $this->klaar = $klaar;

        return $this;
    }
}
