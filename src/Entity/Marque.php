<?php

namespace App\Entity;

use App\Entity\Film;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="integer", length=4, nullable=true)
     */
    private $creation;

    /**
     * 
     * @ORM\ManyToMany(targetEntity=Film::class, mappedBy="marques")
     */
    private $film;

    /**
     * @ORM\OneToMany(targetEntity=Gamme::class, mappedBy="marque", cascade={"all"})
     */
    private $gamme;

 

    public function __construct()
    {
       
        $this->film = new ArrayCollection();
        $this->gamme = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

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

    public function getCreation(): ?string
    {
        return $this->creation;
    }

    public function setCreation(string $creation): self
    {
        $this->creation = $creation;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilm(): Collection
    {
        return $this->film;
    }

    // public function addFilm(Film $film): self
    // {
    //     if (!$this->film->contains($film)) {
    //         $this->film[] = $film;
    //         $film->addMarques($this);
    //     }
    // }

    public function addFilm(Film $film): self
    {
        if (!$this->film->contains($film)) {
            $this->film[] = $film;
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        $this->film->removeElement($film);

        return $this;
    }

    /**
     * @return Collection|Gamme[]
     */
    public function getGamme(): Collection
    {
        return $this->gamme;
    }

    public function addGamme(Gamme $gamme): self
    {
        if (!$this->gamme->contains($gamme)) {
            $this->gamme[] = $gamme;
            $gamme->setMarque($this);
        }

        return $this;
    }

    public function removeGamme(Gamme $gamme): self
    {
        if ($this->gamme->removeElement($gamme)) {
            // set the owning side to null (unless already changed)
            if ($gamme->getMarque() === $this) {
                $gamme->setMarque(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }


    
  // @ORM\ManyToMany(targetEntity=Film::class, inversedBy="marques", cascade={"all"})
  
}
