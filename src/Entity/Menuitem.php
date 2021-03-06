<?php

namespace App\Entity;

use App\Repository\MenuitemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuitemRepository::class)
 */
class Menuitem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Subgerecht::class, inversedBy="menuitems", cascade={"persist", "remove"})
    )
     */
    private $subgerechtId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $menuitem;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs;

    /**
     * @ORM\OneToMany(targetEntity=Bestelling::class, mappedBy="menuitemId")
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

    public function getSubgerechtId(): ?Subgerecht
    {
        return $this->subgerechtId;
    }

    public function setSubgerechtId(?Subgerecht $subgerechtId): self
    {
        $this->subgerechtId = $subgerechtId;

        return $this;
    }

    public function getMenuitem(): ?string
    {
        return $this->menuitem;
    }

    public function setMenuitem(string $menuitem): self
    {
        $this->menuitem = $menuitem;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

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
            $bestelling->setMenuitemId($this);
        }

        return $this;
    }

    public function removeBestelling(Bestelling $bestelling): self
    {
        if ($this->bestellings->removeElement($bestelling)) {
            // set the owning side to null (unless already changed)
            if ($bestelling->getMenuitemId() === $this) {
                $bestelling->setMenuitemId(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getMenuitem();
    }
}
