<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
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
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="date")
     */
    private $sortie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    // /**
    //  * @ORM\ManyToMany(targetEntity=Marque::class, inversedBy="films")
    //  */
    // private $camera;

    /**
     * @ORM\ManyToMany(targetEntity=Modele::class, inversedBy="films")
     */
    private $cameras;

    public function __construct()
    {
        $this->camera = new ArrayCollection();
        $this->cameras = new ArrayCollection();
    }

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

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getSortie(): ?\DateTimeInterface
    {
        return $this->sortie;
    }

    public function setSortie(\DateTimeInterface $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    // /**
    //  * @return Collection|Marque[]
    //  */
    // public function getCamera(): Collection
    // {
    //     return $this->camera;
    // }

    // public function addCamera(Marque $camera): self
    // {
    //     if (!$this->camera->contains($camera)) {
    //         $this->camera[] = $camera;
    //     }

    //     return $this;
    // }

    public function removeCamera(Marque $camera): self
    {
        $this->camera->removeElement($camera);

        return $this;
    }

    /**
     * @return Collection|Modele[]
     */
    public function getCameras(): Collection
    {
        return $this->cameras;
    }
}
