<?php

namespace App\Entity;

use App\Repository\LiaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LiaisonRepository::class)
 */
class Liaison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\OneToMany(targetEntity=Traversee::class, mappedBy="traversee_liaison")
     */
    private $liaison_traversee;

    /**
     * @ORM\ManyToOne(targetEntity=port::class, inversedBy="port_liaisons")
     */
    private $liaison_port;

    /**
     * @ORM\ManyToOne(targetEntity=secteur::class, inversedBy="secteur_liaisons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $liaison_secteur;

    /**
     * @ORM\ManyToMany(targetEntity=periode::class, inversedBy="periode_liaisons")
     */
    private $liaison_periode;

    public function __construct()
    {
        $this->liaison_traversee = new ArrayCollection();
        $this->liaison_periode = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection<int, Traversee>
     */
    public function getLiaisonTraversee(): Collection
    {
        return $this->liaison_traversee;
    }

    public function addLiaisonTraversee(Traversee $liaisonTraversee): self
    {
        if (!$this->liaison_traversee->contains($liaisonTraversee)) {
            $this->liaison_traversee[] = $liaisonTraversee;
            $liaisonTraversee->setTraverseeLiaison($this);
        }

        return $this;
    }

    public function removeLiaisonTraversee(Traversee $liaisonTraversee): self
    {
        if ($this->liaison_traversee->removeElement($liaisonTraversee)) {
            // set the owning side to null (unless already changed)
            if ($liaisonTraversee->getTraverseeLiaison() === $this) {
                $liaisonTraversee->setTraverseeLiaison(null);
            }
        }

        return $this;
    }

    public function getLiaisonPort(): ?port
    {
        return $this->liaison_port;
    }

    public function setLiaisonPort(?port $liaison_port): self
    {
        $this->liaison_port = $liaison_port;

        return $this;
    }

    public function getLiaisonSecteur(): ?secteur
    {
        return $this->liaison_secteur;
    }

    public function setLiaisonSecteur(?secteur $liaison_secteur): self
    {
        $this->liaison_secteur = $liaison_secteur;

        return $this;
    }

    /**
     * @return Collection<int, periode>
     */
    public function getLiaisonPeriode(): Collection
    {
        return $this->liaison_periode;
    }

    public function addLiaisonPeriode(periode $liaisonPeriode): self
    {
        if (!$this->liaison_periode->contains($liaisonPeriode)) {
            $this->liaison_periode[] = $liaisonPeriode;
        }

        return $this;
    }

    public function removeLiaisonPeriode(periode $liaisonPeriode): self
    {
        $this->liaison_periode->removeElement($liaisonPeriode);

        return $this;
    }
}
