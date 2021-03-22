<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ModeleRepository::class)
 * @ORM\Table(name="modele", indexes={@ORM\Index(columns={"name"}, flags={"fulltext"})})
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
     * @ORM\ManyToMany(targetEntity=Film::class, mappedBy="modeles", cascade={"persist"})
     */
    private $films;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Format::class, inversedBy="modeles")
     */
    private $format;

    /**
     * @ORM\ManyToMany(targetEntity=Shutter::class, inversedBy="modeles")
     */
    private $shutter;

    /**
     * @ORM\ManyToMany(targetEntity=Mount::class, inversedBy="modeles")
     */
    private $mount;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="modeles")
     */
    private $marque;

        /**
     * @ORM\Column(type="integer")
     */
    private $decade;

        /**
     * @ORM\Column(type="integer", length=4)
     */
    private $sortie;


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

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getDecade(): ?int
    {
        return $this->decade;
    }

    public function setDecade(int $decade): self
    {
        $this->decade = $decade;

        return $this;
    }

    public function getSortie(): ?string
    {
        return $this->sortie;
    }

    public function setSortie(string $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }



}
