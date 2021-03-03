<?php

namespace App\Entity;

use App\Repository\CentreRepository;
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
     * @ORM\Column(type="integer")
     */
    private $id_centre;

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
     * @ORM\Column(type="blob")
     */
    private $photo_centre;

    public function getId(): ?int
    {
        return $this->id;
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
}
