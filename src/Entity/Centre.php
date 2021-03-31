<?php

namespace App\Entity;

use App\Repository\CentreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CentreRepository::class)
 */
class Centre
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
    private $nom_centre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $description_centre;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_centre;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $photo_centre;

    /**
     * @ORM\OneToMany(targetEntity=Activite::class, mappedBy="Centre", orphanRemoval=true)
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="Centre", orphanRemoval=true)
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity=CentreComment::class, mappedBy="centre")
     */
    private $centreComments;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="centre")
     */
    private $ratings;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="centres")
     */
    private $User;



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
        $this->activites = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->centreComments = new ArrayCollection();
        $this->ratings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomCentre(): ?string
    {
        return $this->nom_centre;
    }

    public function setNomCentre(string $nom_centre): self
    {
        $this->nom_centre = $nom_centre;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDescriptionCentre(): ?string
    {
        return $this->description_centre;
    }

    public function setDescriptionCentre(string $description_centre): self
    {
        $this->description_centre = $description_centre;

        return $this;
    }

    public function getPrixCentre(): ?float
    {
        return $this->prix_centre;
    }

    public function setPrixCentre(float $prix_centre): self
    {
        $this->prix_centre = $prix_centre;

        return $this;
    }

    public function getPhotoCentre()
    {
        return $this->photo_centre;
    }

    public function setPhotoCentre($photo_centre): self
    {
        $this->photo_centre = $photo_centre;

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
            $activite->setCentre($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->removeElement($activite)) {
            // set the owning side to null (unless already changed)
            if ($activite->getCentre() === $this) {
                $activite->setCentre(null);
            }
        }

        return $this;
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
            $reservation->setCentre($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getCentre() === $this) {
                $reservation->setCentre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CentreComment[]
     */
    public function getCentreComments(): Collection
    {
        return $this->centreComments;
    }

    public function addCentreComment(CentreComment $centreComment): self
    {
        if (!$this->centreComments->contains($centreComment)) {
            $this->centreComments[] = $centreComment;
            $centreComment->setCentre($this);
        }

        return $this;
    }

    public function removeCentreComment(CentreComment $centreComment): self
    {
        if ($this->centreComments->removeElement($centreComment)) {
            // set the owning side to null (unless already changed)
            if ($centreComment->getCentre() === $this) {
                $centreComment->setCentre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setCentre($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getCentre() === $this) {
                $rating->setCentre(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
