<?php

namespace App\Entity;

use App\Repository\ShutterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShutterRepository::class)
 */
class Shutter
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
    private $angle;

    /**
     * @ORM\ManyToMany(targetEntity=Cameras::class, mappedBy="shutter")
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

    public function getAngle(): ?string
    {
        return $this->angle;
    }

    public function setAngle(string $angle): self
    {
        $this->angle = $angle;

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
            $camera->addShutter($this);
        }

        return $this;
    }

    public function removeCamera(Cameras $camera): self
    {
        if ($this->cameras->removeElement($camera)) {
            $camera->removeShutter($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->angle;
    }
}
