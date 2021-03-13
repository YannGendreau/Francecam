<?php

namespace App\Entity;

use App\Repository\FormatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormatRepository::class)
 */
class Format
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
     * @ORM\ManyToMany(targetEntity=Cameras::class, mappedBy="format")
     */
    private $cameras;

    public function __construct()
    {
        $this->cameras = new ArrayCollection();
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

    /**
     * @return Collection|Cameras[]
     */
    public function getCameras(): Collection
    {
        return $this->cameras;
    }

    public function addCamera(Cameras $camera): self
    {
        if (!$this->cameras->contains($camera)) {
            $this->cameras[] = $camera;
            $camera->addFormat($this);
        }

        return $this;
    }

    public function removeCamera(Cameras $camera): self
    {
        if ($this->cameras->removeElement($camera)) {
            $camera->removeFormat($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
