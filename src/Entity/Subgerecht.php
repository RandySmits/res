<?php

namespace App\Entity;

use App\Repository\SubgerechtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubgerechtRepository::class)
 */
class Subgerecht
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Gerecht::class, inversedBy="subgerechts", cascade={"persist", "remove"})
     */
    private $gerechtId;

    /**
     * @ORM\OneToMany(targetEntity=Menuitem::class, mappedBy="subgerechtId")
     */
    private $menuitems;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Naam;

    public function __construct()
    {
        $this->menuitems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGerechtId(): ?Gerecht
    {
        return $this->gerechtId;
    }

    public function setGerechtId(?Gerecht $gerechtId): self
    {
        $this->gerechtId = $gerechtId;

        return $this;
    }

    /**
     * @return Collection|Menuitem[]
     */
    public function getMenuitems(): Collection
    {
        return $this->menuitems;
    }

    public function addMenuitem(Menuitem $menuitem): self
    {
        if (!$this->menuitems->contains($menuitem)) {
            $this->menuitems[] = $menuitem;
            $menuitem->setSubgerechtId($this);
        }

        return $this;
    }

    public function removeMenuitem(Menuitem $menuitem): self
    {
        if ($this->menuitems->removeElement($menuitem)) {
            // set the owning side to null (unless already changed)
            if ($menuitem->getSubgerechtId() === $this) {
                $menuitem->setSubgerechtId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getGerechtId();
    }

    public function getNaam(): ?string
    {
        return $this->Naam;
    }

    public function setNaam(string $Naam): self
    {
        $this->Naam = $Naam;

        return $this;
    }
}
