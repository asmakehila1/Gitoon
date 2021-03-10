<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 */
class Promotion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name= "id_promo" , type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre_promo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $desc_promo;

    /**
     * @ORM\Column(type="blob")
     */
    private $image_promo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_promo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }




    public function getTitrePromo(): ?string
    {
        return $this->titre_promo;
    }

    public function setTitrePromo(string $titre_promo): self
    {
        $this->titre_promo = $titre_promo;

        return $this;
    }

    public function getDescPromo(): ?string
    {
        return $this->desc_promo;
    }

    public function setDescPromo(string $desc_promo): self
    {
        $this->desc_promo = $desc_promo;

        return $this;
    }

    public function getImagePromo()
    {
        return $this->image_promo;
    }

    public function setImagePromo($image_promo): self
    {
        $this->image_promo = $image_promo;

        return $this;
    }

    public function getTypePromo(): ?string
    {
        return $this->type_promo;
    }

    public function setTypePromo(string $type_promo): self
    {
        $this->type_promo = $type_promo;

        return $this;
    }
}
