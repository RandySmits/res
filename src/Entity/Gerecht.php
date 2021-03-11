<?php

namespace App\Entity;

use App\Repository\GerechtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GerechtRepository::class)
 */
class Gerecht
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Gerechtnaam;

    /**
     * @ORM\OneToMany(targetEntity=Subgerecht::class, mappedBy="gerechtId", cascade={"persist", "remove"})
     */
    private $subgerechts;

    public function __construct()
    {
        $this->subgerechts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGerechtnaam(): ?string
    {
        return $this->Gerechtnaam;
    }

    public function setGerechtnaam(string $Gerechtnaam): self
    {
        $this->Gerechtnaam = $Gerechtnaam;

        return $this;
    }

    /**
     * @return Collection|Subgerecht[]
     */
    public function getSubgerechts(): Collection
    {
        return $this->subgerechts;
    }

    public function addSubgerecht(Subgerecht $subgerecht): self
    {
        if (!$this->subgerechts->contains($subgerecht)) {
            $this->subgerechts[] = $subgerecht;
            $subgerecht->setGerechtId($this);
        }

        return $this;
    }

    public function removeSubgerecht(Subgerecht $subgerecht): self
    {
        if ($this->subgerechts->removeElement($subgerecht)) {
            // set the owning side to null (unless already changed)
            if ($subgerecht->getGerechtId() === $this) {
                $subgerecht->setGerechtId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getGerechtnaam();
    }
}
