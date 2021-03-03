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
     * @ORM\Column(type="integer")
     */
    private $id_reservation;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_client;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_centre;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_materiel;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_evenement;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_promotion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReservation(): ?int
    {
        return $this->id_reservation;
    }

    public function setIdReservation(int $id_reservation): self
    {
        $this->id_reservation = $id_reservation;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->id_client;
    }

    public function setIdClient(int $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getIdCentre(): ?int
    {
        return $this->id_centre;
    }

    public function setIdCentre(int $id_centre): self
    {
        $this->id_centre = $id_centre;

        return $this;
    }

    public function getIdMateriel(): ?int
    {
        return $this->id_materiel;
    }

    public function setIdMateriel(int $id_materiel): self
    {
        $this->id_materiel = $id_materiel;

        return $this;
    }

    public function getIdEvenement(): ?int
    {
        return $this->id_evenement;
    }

    public function setIdEvenement(int $id_evenement): self
    {
        $this->id_evenement = $id_evenement;

        return $this;
    }

    public function getIdPromotion(): ?int
    {
        return $this->id_promotion;
    }

    public function setIdPromotion(int $id_promotion): self
    {
        $this->id_promotion = $id_promotion;

        return $this;
    }
}
