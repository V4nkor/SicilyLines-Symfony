<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PortRepository::class)
 */
class Port
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
     * @ORM\OneToMany(targetEntity=Liaison::class, mappedBy="liaison_port")
     */
    private $port_liaisons;

    public function __construct()
    {
        $this->port_liaisons = new ArrayCollection();
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

    /**
     * @return Collection<int, Liaison>
     */
    public function getPortLiaisons(): Collection
    {
        return $this->port_liaisons;
    }

    public function addPortLiaison(Liaison $portLiaison): self
    {
        if (!$this->port_liaisons->contains($portLiaison)) {
            $this->port_liaisons[] = $portLiaison;
            $portLiaison->setLiaisonPort($this);
        }

        return $this;
    }

    public function removePortLiaison(Liaison $portLiaison): self
    {
        if ($this->port_liaisons->removeElement($portLiaison)) {
            // set the owning side to null (unless already changed)
            if ($portLiaison->getLiaisonPort() === $this) {
                $portLiaison->setLiaisonPort(null);
            }
        }

        return $this;
    }
}
