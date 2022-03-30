<?php

namespace App\Entity;

use App\Repository\TraverseeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TraverseeRepository::class)
 */
class Traversee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $heure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Categorie;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="reservation_traversee")
     */
    private $traversee_reservation;

    /**
     * @ORM\ManyToOne(targetEntity=liaison::class, inversedBy="liaison_traversee")
     */
    private $traversee_liaison;

    /**
     * @ORM\ManyToOne(targetEntity=bateau::class, inversedBy="bateau_traversee")
     */
    private $traversee_bateau;

    public function __construct()
    {
        $this->traversee_reservation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getTraverseeReservation(): Collection
    {
        return $this->traversee_reservation;
    }

    public function addTraverseeReservation(Reservation $traverseeReservation): self
    {
        if (!$this->traversee_reservation->contains($traverseeReservation)) {
            $this->traversee_reservation[] = $traverseeReservation;
            $traverseeReservation->setReservationTraversee($this);
        }

        return $this;
    }

    public function removeTraverseeReservation(Reservation $traverseeReservation): self
    {
        if ($this->traversee_reservation->removeElement($traverseeReservation)) {
            // set the owning side to null (unless already changed)
            if ($traverseeReservation->getReservationTraversee() === $this) {
                $traverseeReservation->setReservationTraversee(null);
            }
        }

        return $this;
    }

    public function getTraverseeLiaison(): ?liaison
    {
        return $this->traversee_liaison;
    }

    public function setTraverseeLiaison(?liaison $traversee_liaison): self
    {
        $this->traversee_liaison = $traversee_liaison;

        return $this;
    }

    public function getTraverseeBateau(): ?bateau
    {
        return $this->traversee_bateau;
    }

    public function setTraverseeBateau(?bateau $traversee_bateau): self
    {
        $this->traversee_bateau = $traversee_bateau;

        return $this;
    }
}
