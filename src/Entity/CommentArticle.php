<?php

namespace App\Entity;

use App\Repository\CommentArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentArticleRepository::class)
 */
class CommentArticle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="date")
     */
    private $date;


    /**
     * @ORM\ManyToOne(targetEntity=Centre::class, inversedBy="commentarticle")
     * @ORM\JoinColumn(nullable=false)
     */
    private $centre;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commentarticle")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCentre(): ?Centre
    {
        return $this->Centre;
    }

    public function setBlogs(?Blog $Centre): self
    {
        $this->Centre = $Centre;

        return $this;
    }

    public function get(): ?Client
    {
        return $this->Client;
    }

    public function setUser(?Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }
}
