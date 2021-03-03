<?php

namespace App\Entity;

use App\Repository\OrgRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrgRepository::class)
 */
class Org
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $org_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $org_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $org_owner;

    /**
     * @ORM\Column(type="string", length=2500)
     */
    private $org_desc;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $org_link;

    /**
     * @ORM\Column(type="blob")
     */
    private $org_img;

    /**
     * @ORM\OneToMany(targetEntity=OrgEvent::class, mappedBy="org_id")
     */
    private $orgEvents;

    public function __construct()
    {
        $this->orgEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrgId(): ?int
    {
        return $this->org_id;
    }

    public function setOrgId(int $org_id): self
    {
        $this->org_id = $org_id;

        return $this;
    }

    public function getOrgName(): ?string
    {
        return $this->org_name;
    }

    public function setOrgName(string $org_name): self
    {
        $this->org_name = $org_name;

        return $this;
    }

    public function getOrgOwner(): ?string
    {
        return $this->org_owner;
    }

    public function setOrgOwner(string $org_owner): self
    {
        $this->org_owner = $org_owner;

        return $this;
    }

    public function getOrgDesc(): ?string
    {
        return $this->org_desc;
    }

    public function setOrgDesc(string $org_desc): self
    {
        $this->org_desc = $org_desc;

        return $this;
    }

    public function getOrgLink(): ?string
    {
        return $this->org_link;
    }

    public function setOrgLink(string $org_link): self
    {
        $this->org_link = $org_link;

        return $this;
    }

    public function getOrgImg()
    {
        return $this->org_img;
    }

    public function setOrgImg($org_img): self
    {
        $this->org_img = $org_img;

        return $this;
    }

    /**
     * @return Collection|OrgEvent[]
     */
    public function getOrgEvents(): Collection
    {
        return $this->orgEvents;
    }

    public function addOrgEvent(OrgEvent $orgEvent): self
    {
        if (!$this->orgEvents->contains($orgEvent)) {
            $this->orgEvents[] = $orgEvent;
            $orgEvent->setOrgId($this);
        }

        return $this;
    }

    public function removeOrgEvent(OrgEvent $orgEvent): self
    {
        if ($this->orgEvents->removeElement($orgEvent)) {
            // set the owning side to null (unless already changed)
            if ($orgEvent->getOrgId() === $this) {
                $orgEvent->setOrgId(null);
            }
        }

        return $this;
    }
}
