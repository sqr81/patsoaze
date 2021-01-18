<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Actualite::class, mappedBy="categorie")
     */
    private $actualites;

    public function __construct()
    {
        $this->actualites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Actualite[]
     */
    public function getActualites(): Collection
    {
        return $this->actualites;
    }

    public function addActualite(Actualite $actualite): self
    {
        if (!$this->actualites->contains($actualite)) {
            $this->actualites[] = $actualite;
            $actualite->setCategorie($this);
        }

        return $this;
    }

    public function removeActualite(Actualite $actualite): self
    {
        if ($this->actualites->contains($actualite)) {
            $this->actualites->removeElement($actualite);
            // set the owning side to null (unless already changed)
            if ($actualite->getCategorie() === $this) {
                $actualite->setCategorie(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;

    }
}
