<?php

namespace App\Entity;

use App\Repository\ReserveringRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReserveringRepository::class)
 */
class Reservering
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="reserverings")
     */
    private $klantId;

    /**
     * @ORM\ManyToOne(targetEntity=Tafel::class, inversedBy="reserverings")
     */
    private $tafelId;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantalpersonen;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datumtijd;

    /**
     * @ORM\OneToOne(targetEntity=Bon::class, mappedBy="reserveringId", cascade={"persist", "remove"})
     */
    private $bon;

    /**
     * @ORM\OneToMany(targetEntity=Bestelling::class, mappedBy="reserveringId")
     */
    private $bestellings;

    public function __construct()
    {
        $this->bestellings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKlantId(): ?Klant
    {
        return $this->klantId;
    }

    public function setKlantId(?Klant $klantId): self
    {
        $this->klantId = $klantId;

        return $this;
    }

    public function getTafelId(): ?Tafel
    {
        return $this->tafelId;
    }

    public function setTafelId(?Tafel $tafelId): self
    {
        $this->tafelId = $tafelId;

        return $this;
    }

    public function getAantalpersonen(): ?int
    {
        return $this->aantalpersonen;
    }

    public function setAantalpersonen(int $aantalpersonen): self
    {
        $this->aantalpersonen = $aantalpersonen;

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

    public function getBon(): ?Bon
    {
        return $this->bon;
    }

    public function setBon(?Bon $bon): self
    {
        // unset the owning side of the relation if necessary
        if ($bon === null && $this->bon !== null) {
            $this->bon->setReserveringId(null);
        }

        // set the owning side of the relation if necessary
        if ($bon !== null && $bon->getReserveringId() !== $this) {
            $bon->setReserveringId($this);
        }

        $this->bon = $bon;

        return $this;
    }

    /**
     * @return Collection|Bestelling[]
     */
    public function getBestellings(): Collection
    {
        return $this->bestellings;
    }

    public function addBestelling(Bestelling $bestelling): self
    {
        if (!$this->bestellings->contains($bestelling)) {
            $this->bestellings[] = $bestelling;
            $bestelling->setReserveringId($this);
        }

        return $this;
    }

    public function removeBestelling(Bestelling $bestelling): self
    {
        if ($this->bestellings->removeElement($bestelling)) {
            // set the owning side to null (unless already changed)
            if ($bestelling->getReserveringId() === $this) {
                $bestelling->setReserveringId(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getKlantId();
    }
}
