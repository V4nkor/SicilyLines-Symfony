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
     * @ORM\OneToMany(targetEntity=Type::class, mappedBy="type_categorie")
     */
    private $categorie_type;

    public function __construct()
    {
        $this->categorie_type = new ArrayCollection();
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
     * @return Collection<int, Type>
     */
    public function getCategorieType(): Collection
    {
        return $this->categorie_type;
    }

    public function addCategorieType(Type $categorieType): self
    {
        if (!$this->categorie_type->contains($categorieType)) {
            $this->categorie_type[] = $categorieType;
            $categorieType->setTypeCategorie($this);
        }

        return $this;
    }

    public function removeCategorieType(Type $categorieType): self
    {
        if ($this->categorie_type->removeElement($categorieType)) {
            // set the owning side to null (unless already changed)
            if ($categorieType->getTypeCategorie() === $this) {
                $categorieType->setTypeCategorie(null);
            }
        }

        return $this;
    }
}
