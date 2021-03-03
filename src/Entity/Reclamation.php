<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
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
    private $id_reclamation;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_reclamation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $objet_reclamation;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $image_reclamation;

    /**
     * @ORM\Column(type="string", length=1500)
     */
    private $description_reclamation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReclamation(): ?int
    {
        return $this->id_reclamation;
    }

    public function setIdReclamation(int $id_reclamation): self
    {
        $this->id_reclamation = $id_reclamation;

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

    public function getTypeReclamation(): ?string
    {
        return $this->type_reclamation;
    }

    public function setTypeReclamation(string $type_reclamation): self
    {
        $this->type_reclamation = $type_reclamation;

        return $this;
    }

    public function getObjetReclamation(): ?string
    {
        return $this->objet_reclamation;
    }

    public function setObjetReclamation(string $objet_reclamation): self
    {
        $this->objet_reclamation = $objet_reclamation;

        return $this;
    }

    public function getImageReclamation()
    {
        return $this->image_reclamation;
    }

    public function setImageReclamation($image_reclamation): self
    {
        $this->image_reclamation = $image_reclamation;

        return $this;
    }

    public function getDescriptionReclamation(): ?string
    {
        return $this->description_reclamation;
    }

    public function setDescriptionReclamation(string $description_reclamation): self
    {
        $this->description_reclamation = $description_reclamation;

        return $this;
    }
}
