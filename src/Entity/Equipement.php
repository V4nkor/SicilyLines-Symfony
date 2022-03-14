<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipementRepository::class)
 */
class Equipement
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
     * @ORM\ManyToMany(targetEntity=Bateau::class, mappedBy="bateau_equipement")
     */
    private $id_bateau;

    public function __construct()
    {
        $this->id_bateau = new ArrayCollection();
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
     * @return Collection|Bateau[]
     */
    public function getIdBateau(): Collection
    {
        return $this->id_bateau;
    }

    public function addIdBateau(Bateau $idBateau): self
    {
        if (!$this->id_bateau->contains($idBateau)) {
            $this->id_bateau[] = $idBateau;
            $idBateau->addBateauEquipement($this);
        }

        return $this;
    }

    public function removeIdBateau(Bateau $idBateau): self
    {
        if ($this->id_bateau->removeElement($idBateau)) {
            $idBateau->removeBateauEquipement($this);
        }

        return $this;
    }
}
