<?php

namespace App\Entity;

use App\Repository\PubliciteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PubliciteRepository::class)
 */
class Publicite
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
    private $titre_pub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_pub;

    /**
     * @ORM\Column(type="blob")
     */
    private $image_pub;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitrePub(): ?string
    {
        return $this->titre_pub;
    }

    public function setTitrePub(string $titre_pub): self
    {
        $this->titre_pub = $titre_pub;

        return $this;
    }

    public function getDescriptionPub(): ?string
    {
        return $this->description_pub;
    }

    public function setDescriptionPub(string $description_pub): self
    {
        $this->description_pub = $description_pub;

        return $this;
    }

    public function getImagePub()
    {
        return $this->image_pub;
    }

    public function setImagePub($image_pub): self
    {
        $this->image_pub = $image_pub;

        return $this;
    }
}
