<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=periode::class, inversedBy="periode_type")
     */
    private $type_periode;

    /**
     * @ORM\ManyToOne(targetEntity=categorie::class, inversedBy="categorie_type")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_categorie;

    public function __construct()
    {
        $this->type_periode = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, periode>
     */
    public function getTypePeriode(): Collection
    {
        return $this->type_periode;
    }

    public function addTypePeriode(periode $typePeriode): self
    {
        if (!$this->type_periode->contains($typePeriode)) {
            $this->type_periode[] = $typePeriode;
        }

        return $this;
    }

    public function removeTypePeriode(periode $typePeriode): self
    {
        $this->type_periode->removeElement($typePeriode);

        return $this;
    }

    public function getTypeCategorie(): ?categorie
    {
        return $this->type_categorie;
    }

    public function setTypeCategorie(?categorie $type_categorie): self
    {
        $this->type_categorie = $type_categorie;

        return $this;
    }
}
