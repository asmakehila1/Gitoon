<?php

namespace App\Entity;

use App\Repository\StoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StoriesRepository::class)
 */
class Stories
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $ss_id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $ss_title;

    /**
     * @ORM\Column(type="string", length=2500)
     */
    private $ss_desc;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $ss_link;

    /**
     * @ORM\Column(type="blob")
     */
    private $ss_img;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSsId(): ?int
    {
        return $this->ss_id;
    }

    public function setSsId(int $ss_id): self
    {
        $this->ss_id = $ss_id;

        return $this;
    }

    public function getSsTitle(): ?string
    {
        return $this->ss_title;
    }

    public function setSsTitle(string $ss_title): self
    {
        $this->ss_title = $ss_title;

        return $this;
    }

    public function getSsDesc(): ?string
    {
        return $this->ss_desc;
    }

    public function setSsDesc(string $ss_desc): self
    {
        $this->ss_desc = $ss_desc;

        return $this;
    }

    public function getSsLink(): ?string
    {
        return $this->ss_link;
    }

    public function setSsLink(string $ss_link): self
    {
        $this->ss_link = $ss_link;

        return $this;
    }

    public function getSsImg()
    {
        return $this->ss_img;
    }

    public function setSsImg($ss_img): self
    {
        $this->ss_img = $ss_img;

        return $this;
    }
}
