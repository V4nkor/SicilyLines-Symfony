<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, mappedBy="client_reservation", cascade={"persist", "remove"})
     */
    private $reservation_client;

    /**
     * @ORM\ManyToOne(targetEntity=traversee::class, inversedBy="traversee_reservation")
     */
    private $reservation_traversee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationClient(): ?Client
    {
        return $this->reservation_client;
    }

    public function setReservationClient(?Client $reservation_client): self
    {
        // unset the owning side of the relation if necessary
        if ($reservation_client === null && $this->reservation_client !== null) {
            $this->reservation_client->setClientReservation(null);
        }

        // set the owning side of the relation if necessary
        if ($reservation_client !== null && $reservation_client->getClientReservation() !== $this) {
            $reservation_client->setClientReservation($this);
        }

        $this->reservation_client = $reservation_client;

        return $this;
    }

    public function getReservationTraversee(): ?traversee
    {
        return $this->reservation_traversee;
    }

    public function setReservationTraversee(?traversee $reservation_traversee): self
    {
        $this->reservation_traversee = $reservation_traversee;

        return $this;
    }
}
