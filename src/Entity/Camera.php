<?php

namespace App\Entity;

use App\Entity\Modele;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CameraRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CameraRepository::class)
 */
class Camera
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="cameras")
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="camera")
     */
    private $modele;

    /**
     * @ORM\ManyToMany(targetEntity=Film::class, mappedBy="camera")
     */
    private $films;

    /**
     * Undocumented variable
     *@ORM\Column(type="string", length=255)
     * 
     */
    private $marqueModele;



    public function __construct()
    {
        // $this->modele = new ArrayCollection();
        $this->films = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
            $film->addCamera($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->removeElement($film)) {
            $film->removeCamera($this);
        }

        return $this;
    }

 
    public function setMarqueModele($marqueModele) 
    {
        $this->marqueModele = $marqueModele;

        return $this;
    }
    
    public function getMarqueModele() 
    {
        return $this->marqueModele;
    }

    public function __toString()
    {
        return $this->marqueModele;
    }

    public function cameraName()
    {
        return $this->marque . ' ' . $this->modele;
    }

  
}
