<?php

namespace App\Entity;

use App\Repository\MaterielsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielsRepository::class)
 */
class Materiels
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
    private $Nom_mat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix_mat;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $duree_location;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $statu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo_materiel;
    /**
     * @ORM\Column(type="blob")
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMat(): ?string
    {
        return $this->Nom_mat;
    }

    public function setNomMat(string $Nom_mat): self
    {
        $this->Nom_mat = $Nom_mat;

        return $this;
    }

    public function getPrixMat(): ?float
    {
        return $this->prix_mat;
    }

    public function setPrixMat(float $prix_mat): self
    {
        $this->prix_mat = $prix_mat;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDureeLocation(): ?\DateInterval
    {
        return $this->duree_location;
    }

    public function setDureeLocation(\DateInterval $duree_location): self
    {
        $this->duree_location = $duree_location;

        return $this;
    }

    public function getStatu(): ?string
    {
        return $this->statu;
    }

    public function setStatu(string $statu): self
    {
        $this->statu = $statu;

        return $this;
    }

    public function getPhotoMateriel()
    {
        return $this->photo_materiel;
    }

    public function setPhotoMateriel($photo_materiel): self
    {
        $this->photo_materiel = $photo_materiel;

        return $this;
    }
}
