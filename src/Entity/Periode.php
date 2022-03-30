<?php

namespace App\Entity;

use App\Repository\PeriodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeriodeRepository::class)
 */
class Periode
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
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\ManyToMany(targetEntity=Liaison::class, mappedBy="liaison_periode")
     */
    private $periode_liaisons;

    /**
     * @ORM\ManyToMany(targetEntity=Type::class, mappedBy="type_periode")
     */
    private $periode_type;

    public function __construct()
    {
        $this->periode_liaisons = new ArrayCollection();
        $this->periode_type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, Liaison>
     */
    public function getPeriodeLiaisons(): Collection
    {
        return $this->periode_liaisons;
    }

    public function addPeriodeLiaison(Liaison $periodeLiaison): self
    {
        if (!$this->periode_liaisons->contains($periodeLiaison)) {
            $this->periode_liaisons[] = $periodeLiaison;
            $periodeLiaison->addLiaisonPeriode($this);
        }

        return $this;
    }

    public function removePeriodeLiaison(Liaison $periodeLiaison): self
    {
        if ($this->periode_liaisons->removeElement($periodeLiaison)) {
            $periodeLiaison->removeLiaisonPeriode($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getPeriodeType(): Collection
    {
        return $this->periode_type;
    }

    public function addPeriodeType(Type $periodeType): self
    {
        if (!$this->periode_type->contains($periodeType)) {
            $this->periode_type[] = $periodeType;
            $periodeType->addTypePeriode($this);
        }

        return $this;
    }

    public function removePeriodeType(Type $periodeType): self
    {
        if ($this->periode_type->removeElement($periodeType)) {
            $periodeType->removeTypePeriode($this);
        }

        return $this;
    }
}
