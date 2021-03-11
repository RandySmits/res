<?php

namespace App\Entity;

use App\Repository\TafelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TafelRepository::class)
 */
class Tafel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $tafalnummer;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxpersonen;

    /**
     * @ORM\OneToMany(targetEntity=Reservering::class, mappedBy="tafelId", cascade={"persist", "remove"})
    )
     */
    private $reserverings;

    public function __construct()
    {
        $this->reserverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTafalnummer(): ?int
    {
        return $this->tafalnummer;
    }

    public function setTafalnummer(int $tafalnummer): self
    {
        $this->tafalnummer = $tafalnummer;

        return $this;
    }

    public function getMaxpersonen(): ?int
    {
        return $this->maxpersonen;
    }

    public function setMaxpersonen(int $maxpersonen): self
    {
        $this->maxpersonen = $maxpersonen;

        return $this;
    }

    /**
     * @return Collection|Reservering[]
     */
    public function getReserverings(): Collection
    {
        return $this->reserverings;
    }

    public function addReservering(Reservering $reservering): self
    {
        if (!$this->reserverings->contains($reservering)) {
            $this->reserverings[] = $reservering;
            $reservering->setTafelId($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->removeElement($reservering)) {
            // set the owning side to null (unless already changed)
            if ($reservering->getTafelId() === $this) {
                $reservering->setTafelId(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getTafalnummer();
    }
}
