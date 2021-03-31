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
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @ORM\ManyToOne(targetEntity=Centre::class, inversedBy="reservations")
     */
    private $Centre;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="reservations")
     */
    private $Evenement;

    /**
     * @ORM\ManyToOne(targetEntity=Materiels::class, inversedBy="reservations")
     */
    private $Materiels;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     */
    private $Client;

    /**
     * @ORM\Column(type="text")
     */
    private $Qrcode;








    public function getCentre(): ?Centre
    {
        return $this->Centre;
    }

    public function setCentre(?Centre $Centre): self
    {
        $this->Centre = $Centre;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->Evenement;
    }

    public function setEvenement(?Evenement $Evenement): self
    {
        $this->Evenement = $Evenement;

        return $this;
    }

    public function getMateriels(): ?Materiels
    {
        return $this->Materiels;
    }

    public function setMateriels(?Materiels $Materiels): self
    {
        $this->Materiels = $Materiels;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->Client;
    }

    public function setClient(?User $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getQrcode(): ?string
    {
        return $this->Qrcode;
    }

    public function setQrcode(string $Qrcode): self
    {
        $this->Qrcode = $Qrcode;

        return $this;
    }




}
