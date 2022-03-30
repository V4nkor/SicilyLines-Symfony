<?php

namespace App\Entity;

use App\Repository\SecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SecteurRepository::class)
 */
class Secteur
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
     * @ORM\OneToMany(targetEntity=Liaison::class, mappedBy="liaison_secteur")
     */
    private $secteur_liaisons;

    public function __construct()
    {
        $this->secteur_liaisons = new ArrayCollection();
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
     * @return Collection<int, Liaison>
     */
    public function getSecteurLiaisons(): Collection
    {
        return $this->secteur_liaisons;
    }

    public function addSecteurLiaison(Liaison $secteurLiaison): self
    {
        if (!$this->secteur_liaisons->contains($secteurLiaison)) {
            $this->secteur_liaisons[] = $secteurLiaison;
            $secteurLiaison->setLiaisonSecteur($this);
        }

        return $this;
    }

    public function removeSecteurLiaison(Liaison $secteurLiaison): self
    {
        if ($this->secteur_liaisons->removeElement($secteurLiaison)) {
            // set the owning side to null (unless already changed)
            if ($secteurLiaison->getLiaisonSecteur() === $this) {
                $secteurLiaison->setLiaisonSecteur(null);
            }
        }

        return $this;
    }
}
