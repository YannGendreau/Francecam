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
     * @ORM\ManyToMany(targetEntity=Modele::class, mappedBy="shutter")
     */
    private $modeles;


    public function __construct()
    {
        $this->modeles = new ArrayCollection();
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


    public function __toString()
    {
        return $this->angle;
    }

    /**
     * @return Collection|Modele[]
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): self
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles[] = $modele;
            $modele->addShutter($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            $modele->removeShutter($this);
        }

        return $this;
    }
}
