<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ModeleRepository::class)
 */
class Modele
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $noise;

    /**
    * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $shutter;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $mount;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $framerate;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $perfs;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $magazine;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $voltage;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $view;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $sync;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="modeles", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type(type="App\Entity\Marque")
     * @Assert\Valid
     */
    private $marque;

    /**
     * @ORM\ManyToMany(targetEntity=Film::class, mappedBy="modeles", cascade={"persist"})
     */
    private $films;

    /**
     * @ORM\OneToMany(targetEntity=Camera::class, mappedBy="modele")
     */
    private $camera;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;


    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->marques = new ArrayCollection();
        // $this->camera = new ArrayCollection();
      
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNoise(): ?string
    {
        return $this->noise;
    }

    public function setNoise(string $noise): self
    {
        $this->noise = $noise;

        return $this;
    }

    public function getShutter(): ?string
    {
        return $this->shutter;
    }

    public function setShutter(string $shutter): self
    {
        $this->shutter = $shutter;

        return $this;
    }

    public function getMount(): ?string
    {
        return $this->mount;
    }

    public function setMount(string $mount): self
    {
        $this->mount = $mount;

        return $this;
    }

    public function getFramerate(): ?string
    {
        return $this->framerate;
    }

    public function setFramerate(string $framerate): self
    {
        $this->framerate = $framerate;

        return $this;
    }

    public function getPerfs(): ?string
    {
        return $this->perfs;
    }

    public function setPerfs(string $perfs): self
    {
        $this->perfs = $perfs;

        return $this;
    }

    public function getMagazine(): ?string
    {
        return $this->magazine;
    }

    public function setMagazine(string $magazine): self
    {
        $this->magazine = $magazine;

        return $this;
    }

    public function getVoltage(): ?string
    {
        return $this->voltage;
    }

    public function setVoltage(string $voltage): self
    {
        $this->voltage = $voltage;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getView(): ?string
    {
        return $this->view;
    }

    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getSync(): ?string
    {
        return $this->sync;
    }

    public function setSync(string $sync): self
    {
        $this->sync = $sync;

        return $this;
    }


    public function __toString()
    {
        return $this->name;
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
            $film->addModele($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->removeElement($film)) {
            $film->removeModele($this);
        }

        return $this;
    }

    /**
     * @return Collection|Camera[]
     */
    public function getCamera(): Collection
    {
        return $this->camera;
    }

    public function addCamera(Camera $camera): self
    {
        if (!$this->camera->contains($camera)) {
            $this->camera[] = $camera;
            $camera->setModele($this);
        }

        return $this;
    }

    public function removeCamera(Camera $camera): self
    {
        if ($this->camera->removeElement($camera)) {
            // set the owning side to null (unless already changed)
            if ($camera->getModele() === $this) {
                $camera->setModele(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }



}
