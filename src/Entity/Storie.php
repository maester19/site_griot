<?php

namespace App\Entity;

use App\Repository\StorieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StorieRepository::class)
 */
class Storie
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
    private $titre;

    /**
     * @ORM\Column(type="array")
     */
    private $chap = [];

    /**
     * @ORM\ManyToOne(targetEntity=Auteur::class, inversedBy="stories")
     */
    private $auteur;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="stories")
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getChap(): ?array
    {
        return $this->chap;
    }

    public function setChap(array $chap): self
    {
        $this->chap = $chap;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getType(): ?Categorie
    {
        return $this->type;
    }

    public function setType(?Categorie $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
