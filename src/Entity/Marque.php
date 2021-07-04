<?php

namespace App\Entity;

use App\Entity\Film;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MarqueRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert; 
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 * @Vich\Uploadable()
 * @ORM\Table(name="marque", indexes={@ORM\Index(columns={"name"}, flags={"fulltext"})})
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
     * @ORM\Column(type="string", length=500, nullable=true)
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
     */
    private $films;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;



    /**
     * @ORM\Column(type="string", length=100)
     */
    private $logoName;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="marque_images", fileNameProperty="logoName")
     */
    private $logoFile;

        /**
        *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Modele::class, mappedBy="marque")
     */
    private $modeles;

    /**
     * @ORM\OneToMany(targetEntity=Camera::class, mappedBy="marque")
     */
    private $cameras;



    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->updatedAt = new \DateTime();
        $this->modeles = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCreation(): ?int
    {
        return $this->creation;
    }

    public function setCreation(?int $creation): self
    {
        $this->creation = $creation;

        return $this;
    }

    public function __toString()
    {
        return $this->name; return $this->getModeles;
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
            $film->addMarque($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->removeElement($film)) {
            $film->removeMarque($this);
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
     * Get the value of marqueName
     */ 
    public function getLogoName()
    {
        return $this->logoName;
    }

    /**
     * Set the value of logoName
     *
     * @return  self
     */ 
    public function setLogoName($logoName)
    {
        $this->logoName = $logoName;

        return $this;
    }

    /**
     * Get the value of logoFile
     *
     * @return  File|null
     */ 
    public function getLogoFile()
    {
        return $this->logoFile;
    }

    /**
     * Set the value of logoFile
     *
     * @param  File|null  $logoFile
     *
     * @return  self
     */ 
    public function setLogoFile($logoFile)
    {
        $this->logoFile = $logoFile;

        if($logoFile) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
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
            $modele->setMarque($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getMarque() === $this) {
                $modele->setMarque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Camera[]
     */
    public function getCameras(): Collection
    {
        return $this->cameras;
    }

    public function addCamera(Camera $camera): self
    {
        if (!$this->cameras->contains($camera)) {
            $this->cameras[] = $camera;
            $camera->setMarque($this);
        }

        return $this;
    }

    public function removeCamera(Camera $camera): self
    {
        if ($this->cameras->removeElement($camera)) {
            // set the owning side to null (unless already changed)
            if ($camera->getMarque() === $this) {
                $camera->setMarque(null);
            }
        }

        return $this;
    }
    
}