<?php

namespace App\Entity;

use App\Repository\CamerasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CamerasRepository::class)
 */
class Cameras
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
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $noise;

   

    /**
     * @ORM\Column(type="float")
     */
    private $voltage;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $view;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Film::class, mappedBy="cameraModele")
     */
    private $films;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="cameraModele")
     */
    private $marqueRel;

    /**
     * @ORM\ManyToMany(targetEntity=Format::class, inversedBy="cameras")
     */
    private $format;

    /**
     * @ORM\ManyToMany(targetEntity=Shutter::class, inversedBy="cameras")
     */
    private $shutter;

    /**
     * @ORM\ManyToMany(targetEntity=Mount::class, inversedBy="cameras")
     */
    private $mount;


    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->format = new ArrayCollection();
        $this->shutter = new ArrayCollection();
        $this->mount = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

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

    public function getNoise(): ?int
    {
        return $this->noise;
    }

    public function setNoise(int $noise): self
    {
        $this->noise = $noise;

        return $this;
    }

    

    public function getVoltage(): ?float
    {
        return $this->voltage;
    }

    public function setVoltage(float $voltage): self
    {
        $this->voltage = $voltage;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
            $film->addCameraModele($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->removeElement($film)) {
            $film->removeCameraModele($this);
        }

        return $this;
    }
    public function __toString()
    {
        // return $this->marque;
        // return $this->modele ;
        return $this->marque. ' ' . $this->modele;
    }

    public function getMarqueRel(): ?Marque
    {
        return $this->marqueRel;
    }

    public function setMarqueRel(?Marque $marqueRel): self
    {
        $this->marqueRel = $marqueRel;

        return $this;
    }

    /**
     * @return Collection|Format[]
     */
    public function getFormat(): Collection
    {
        return $this->format;
    }

    public function addFormat(Format $format): self
    {
        if (!$this->format->contains($format)) {
            $this->format[] = $format;
        }

        return $this;
    }

    public function removeFormat(Format $format): self
    {
        $this->format->removeElement($format);

        return $this;
    }

    /**
     * @return Collection|Shutter[]
     */
    public function getShutter(): Collection
    {
        return $this->shutter;
    }

    public function addShutter(Shutter $shutter): self
    {
        if (!$this->shutter->contains($shutter)) {
            $this->shutter[] = $shutter;
        }

        return $this;
    }

    public function removeShutter(Shutter $shutter): self
    {
        $this->shutter->removeElement($shutter);

        return $this;
    }

    /**
     * @return Collection|Mount[]
     */
    public function getMount(): Collection
    {
        return $this->mount;
    }

    public function addMount(Mount $mount): self
    {
        if (!$this->mount->contains($mount)) {
            $this->mount[] = $mount;
        }

        return $this;
    }

    public function removeMount(Mount $mount): self
    {
        $this->mount->removeElement($mount);

        return $this;
    }
 
}
