<?php

namespace App\Entity;

use App\Repository\OrgEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrgEventRepository::class)
 */
class OrgEvent
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $eorg_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eorg_name;

    /**
     * @ORM\Column(type="string", length=2500)
     */
    private $eorg_desc;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $eorg_link;

    /**
     * @ORM\Column(type="blob")
     */
    private $eorg_img;

    /**
     * @ORM\ManyToOne(targetEntity=Org::class, inversedBy="orgEvents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $org_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEorgId(): ?int
    {
        return $this->eorg_id;
    }

    public function setEorgId(int $eorg_id): self
    {
        $this->eorg_id = $eorg_id;

        return $this;
    }

    public function getEorgName(): ?string
    {
        return $this->eorg_name;
    }

    public function setEorgName(string $eorg_name): self
    {
        $this->eorg_name = $eorg_name;

        return $this;
    }

    public function getEorgDesc(): ?string
    {
        return $this->eorg_desc;
    }

    public function setEorgDesc(string $eorg_desc): self
    {
        $this->eorg_desc = $eorg_desc;

        return $this;
    }

    public function getEorgLink(): ?string
    {
        return $this->eorg_link;
    }

    public function setEorgLink(string $eorg_link): self
    {
        $this->eorg_link = $eorg_link;

        return $this;
    }

    public function getEorgImg()
    {
        return $this->eorg_img;
    }

    public function setEorgImg($eorg_img): self
    {
        $this->eorg_img = $eorg_img;

        return $this;
    }

    public function getOrgId(): ?Org
    {
        return $this->org_id;
    }

    public function setOrgId(?Org $org_id): self
    {
        $this->org_id = $org_id;

        return $this;
    }
}
