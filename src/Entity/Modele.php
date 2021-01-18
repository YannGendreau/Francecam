<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $noise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shutter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $framerate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $perfs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $magazine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voltage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $view;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sync;

    /**
     * @ORM\ManyToOne(targetEntity=Gamme::class, inversedBy="Modele")
     */
    private $gamme;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getGamme(): ?Gamme
    {
        return $this->gamme;
    }

    public function setGamme(?Gamme $gamme): self
    {
        $this->gamme = $gamme;

        return $this;
    }

    
}
