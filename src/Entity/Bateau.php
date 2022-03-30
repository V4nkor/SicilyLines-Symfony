<?php

namespace App\Entity;

use App\Repository\BateauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BateauRepository::class)
 */
class Bateau
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
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $longueur;

    /**
     * @ORM\Column(type="float")
     */
    private $largeur;

    /**
     * @ORM\Column(type="integer")
     */
    private $vitesse;

    /**
     * @ORM\ManyToMany(targetEntity=equipement::class, inversedBy="id_bateau")
     */
    private $bateau_equipement;

    /**
     * @ORM\OneToMany(targetEntity=Traversee::class, mappedBy="traversee_bateau")
     */
    private $bateau_traversee;

    public function __construct()
    {
        $this->bateau_equipement = new ArrayCollection();
        $this->bateau_traversee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLongueur(): ?float
    {
        return $this->longueur;
    }

    public function setLongueur(float $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?float
    {
        return $this->largeur;
    }

    public function setLargeur(float $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getVitesse(): ?int
    {
        return $this->vitesse;
    }

    public function setVitesse(int $vitesse): self
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    /**
     * @return Collection|equipement[]
     */
    public function getBateauEquipement(): Collection
    {
        return $this->bateau_equipement;
    }

    public function addBateauEquipement(equipement $bateauEquipement): self
    {
        if (!$this->bateau_equipement->contains($bateauEquipement)) {
            $this->bateau_equipement[] = $bateauEquipement;
        }

        return $this;
    }

    public function removeBateauEquipement(equipement $bateauEquipement): self
    {
        $this->bateau_equipement->removeElement($bateauEquipement);

        return $this;
    }

    /**
     * @return Collection<int, Traversee>
     */
    public function getBateauTraversee(): Collection
    {
        return $this->bateau_traversee;
    }

    public function addBateauTraversee(Traversee $bateauTraversee): self
    {
        if (!$this->bateau_traversee->contains($bateauTraversee)) {
            $this->bateau_traversee[] = $bateauTraversee;
            $bateauTraversee->setTraverseeBateau($this);
        }

        return $this;
    }

    public function removeBateauTraversee(Traversee $bateauTraversee): self
    {
        if ($this->bateau_traversee->removeElement($bateauTraversee)) {
            // set the owning side to null (unless already changed)
            if ($bateauTraversee->getTraverseeBateau() === $this) {
                $bateauTraversee->setTraverseeBateau(null);
            }
        }

        return $this;
    }
}
