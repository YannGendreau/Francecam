<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\ModeleRepository;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ModeleRepository::class)
 * @Vich\Uploadable()
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
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer", length=2, nullable= true)
     */
    private $noise;

    /**
     * @ORM\Column(type="string", length=50, nullable= true)
     */
    private $framerate;

    /**
     * @ORM\Column(type="string", length=50, nullable= true)
     */
    private $perfs;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $magazine;

    /**
     * @ORM\Column(type="string", length=50, nullable= true)
     */
    private $voltage;

    /**
     * @ORM\Column(type="string", length=10, nullable= true)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $view;

    /**
     * @ORM\Column(type="string", length=100, nullable= true)
     */
    private $sync;

    /*
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
     * @ORM\Column(type="integer", length= 255)
     */
    private $decade;

        /**
     * @ORM\Column(type="integer", length=4, nullable=true)
     */
    private $sortie;

          /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $img;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="camera_images", fileNameProperty="img")
     */
    private $imgFile;

    /**
        *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

        /**
     
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Type::class, inversedBy="modeles")
     */
    private $type;

        /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity=Camera::class, mappedBy="modele")
     */
    private $cameras;


    public function __construct()
    {
        // $this->films = new ArrayCollection();
        $this->format = new ArrayCollection();
        $this->shutter = new ArrayCollection();
        $this->mount = new ArrayCollection();
        $this->updatedAt = new \DateTime();
        $this->type = new ArrayCollection();
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function setPerfs(?string $perfs): self
    {
        $this->perfs = $perfs;

        return $this;
    }

    public function getMagazine(): ?string
    {
        return $this->magazine;
    }

    public function setMagazine(?string $magazine): self
    {
        $this->magazine = $magazine;

        return $this;
    }

    public function getVoltage(): ?string
    {
        return $this->voltage;
    }

    public function setVoltage(?string $voltage): self
    {
        $this->voltage = $voltage;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getView(): ?string
    {
        return $this->view;
    }

    public function setView(?string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getSync(): ?string
    {
        return $this->sync;
    }

    public function setSync(?string $sync): self
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

     /**
     * Get the value of marqueName
     */ 
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of logoName
     *
     * @return  self
     */ 
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

        /**
     * Get
     * @return null|File
     
     */ 
    public function getImgFile(): ?File
    {
        return $this->imgFile;
    }

    /**
     * Set /*
     *@param null|File
     * @return  self
     */ 
    public function setImgFile(?File $imgFile)
    {
        $this->imgFile = $imgFile;

        if($imgFile) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return Collection|Type[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Type $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        $this->type->removeElement($type);

        return $this;
    }

    /**
     * Get the value of website
     */ 
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set the value of website
     *
     * @return  self
     */ 
    public function setWebsite($website)
    {
        $this->website = $website;

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
            $camera->setModele($this);
        }

        return $this;
    }

    public function removeCamera(Camera $camera): self
    {
        if ($this->cameras->removeElement($camera)) {
            // set the owning side to null (unless already changed)
            if ($camera->getModele() === $this) {
                $camera->setModele(null);
            }
        }

        return $this;
    }
}
