<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActiviteRepository::class)
 */
class Activite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_activite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DescreptionActivite;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixActivite;

    /**
     * @ORM\ManyToOne(targetEntity=Centre::class, inversedBy="activites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Centre;




    public function getIdActivite() : ?int
    {
        return $this->id_activite;
    }



    public function getDescreptionActivite(): ?string
    {
        return $this->DescreptionActivite;
    }

    public function setDescreptionActivite(string $DescreptionActivite): self
    {
        $this->DescreptionActivite = $DescreptionActivite;

        return $this;
    }

    public function getPrixActivite(): ?float
    {
        return $this->PrixActivite;
    }

    public function setPrixActivite(float $PrixActivite): self
    {
        $this->PrixActivite = $PrixActivite;

        return $this;
    }

    public function getCentre(): ?Centre
    {
        return $this->Centre;
    }

    public function setCentre(?Centre $Centre): self
    {
        $this->Centre = $Centre;

        return $this;
    }
}
