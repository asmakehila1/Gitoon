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
     * @ORM\Column(type="string",length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeLocation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statu;

    /**
     * @ORM\Column(type="blob")
     */
    private $photo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return mixed
     */
    public function getDureeLocation()
    {
        return $this->dureeLocation;
    }

    /**
     * @param mixed $dureeLocation
     */
    public function setDureeLocation($dureeLocation): void
    {
        $this->dureeLocation = $dureeLocation;
    }

    /**
     * @return mixed
     */
    public function getStatu()
    {
        return $this->statu;
    }

    /**
     * @param mixed $statu
     */
    public function setStatu($statu): void
    {
        $this->statu = $statu;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }


}