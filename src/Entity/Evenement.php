<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement extends AbstractController
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="float")
     */
    private $prix_event;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $descrption_event;

    /**
     * @ORM\Column(type="string",length=2000)
     */
    private $photo_event;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="Evenement")
     */
    private $reservations;




    /**
     * Transform to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }



    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixEvent(): ?float
    {
        return $this->prix_event;
    }

    public function setPrixEvent(float $prix_event): self
    {
        $this->prix_event = $prix_event;

        return $this;
    }

    public function getDescrptionEvent(): ?string
    {
        return $this->descrption_event;
    }

    public function setDescrptionEvent(string $descrption_event): self
    {
        $this->descrption_event = $descrption_event;

        return $this;
    }

    public function getPhotoEvent():?string
    {
        return $this->photo_event;
    }

    public function setPhotoEvent(String $photo_event): self
    {
        $this->photo_event = $photo_event;

        return $this;
    }
    public function affiche(){
        $repo=$this->getDoctrine()->getRepository(evenement::class);
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setEvenement($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getEvenement() === $this) {
                $reservation->setEvenement(null);
            }
        }

        return $this;
    }
}
