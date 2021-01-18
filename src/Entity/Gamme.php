<?php

namespace App\Entity;

use App\Repository\GammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GammeRepository::class)
 */
class Gamme
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
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="Gamme")
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity=Modele::class, mappedBy="gamme")
     */
    private $Modele;

    public function __construct()
    {
        $this->Modele = new ArrayCollection();
    }

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
     * @return Collection|Modele[]
     */
    public function getModele(): Collection
    {
        return $this->Modele;
    }

    public function addModele(Modele $modele): self
    {
        if (!$this->Modele->contains($modele)) {
            $this->Modele[] = $modele;
            $modele->setGamme($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): self
    {
        if ($this->Modele->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getGamme() === $this) {
                $modele->setGamme(null);
            }
        }

        return $this;
    }
}
