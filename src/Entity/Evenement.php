<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement extends AbstractController
{
    /**
     * @ORM\Id
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
    private $nom;

    /**
     * @ORM\Column(type="text", length=2000)
     */
    private $descrption_event;

    /**
     * @ORM\Column(type="date", length=2000, nullable=true)
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date", length=2000, nullable=true)
     */
    private $date_fin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank(message="Please upload image")
     * @Assert\File(mimeTypes={"image/jpeg"})
     */
    private $photo_event;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="Evenement", cascade="all")
     */
    private $reservations;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participation", mappedBy="evenement")
     */
    private $participations;

    /**
     * @return ArrayCollection
     */
    public function getParticipations(): ArrayCollection
    {
        return $this->participations;
    }

    /**
     * @param ArrayCollection $participations
     */
    public function setParticipations(ArrayCollection $participations): void
    {
        $this->participations = $participations;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif): void
    {
        $this->actif = $actif;
    }




    public function __construct()
    {
        $this->participations = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getPhotoEvent()
    {
        return $this->photo_event;
    }

    public function setPhotoEvent($photo_event): self
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

    /**
     * @return mixed
     */
    public function getDate_debut()
    {
        return $this->date_debut;
    }

    /**
     * @param mixed $date_debut
     */
    public function setDate_debut($date_debut): void
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return mixed
     */
    public function getDate_fin()
    {
        return $this->date_fin;
    }

    /**
     * @param mixed $date_fin
     */
    public function setDate_fin($date_fin): void
    {
        $this->date_fin = $date_fin;
    }



    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }


    public function setDateDebut($date_debut): void
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }


    public function setDateFin($date_fin): void
    {
        $this->date_fin = $date_fin;
    }




    public function __toString()
    {
        return $this->getNom();
    }

}
