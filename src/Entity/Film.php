<?php

namespace App\Entity;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Director;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
*@ORM\Entity(repositoryClass="App\Repository\FilmRepository")
*
* @Vich\Uploadable()
* @ORM\Table(name="film", indexes={@ORM\Index(columns={"title"}, flags={"fulltext"})})
* @UniqueEntity(
*    fields={"title"})
*/
class Film
{
  
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(max=4)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $synopsis;

    /**
     * @ORM\Column(type="integer")
     */
    private $decade;

    /**
     * @ORM\Column(type="integer", length = 4)
     */
    private $sortie;

    /**
    * @var Collection|Marque[]
    */
    private $marques;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="films")
     * @Assert\Count(
     *      max = 2,
     *    
     * )
     */
    private $genres;

    /**
     * @var Collection|Modele[]
     */
    private $modeles;

      /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $poster;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="posters", fileNameProperty="poster")
     */
    private $posterFile;

    /**
        *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Director::class, inversedBy="films")
     */
    private $directors;

    /**
     
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Dirphoto::class, inversedBy="films")
     */
    private $dirphoto;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="film")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Pays::class, inversedBy="films")
     */
    private $pays;

    /**
     * @ORM\ManyToMany(targetEntity=Camera::class, inversedBy="films", cascade={"persist", "remove"})
     */
    private $camera;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videolink;

    /**
     * @ORM\Column(type="boolean", options={"default":false}, nullable = true)
     */
    private $isVerified;

    /**
    * 
    */
    protected $captchaCode;

     

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->updatedAt = new \DateTime();
        $this->directors = new ArrayCollection();
        $this->dirphoto = new ArrayCollection();
        $this->pays = new ArrayCollection();
        $this->camera = new ArrayCollection();
 
       
    }

    public function getRuntime(int $duree)
    {
        $minutes = $duree;

        $hours = floor($minutes / 60);
        $min = $minutes - ($hours * 60);

        if($hours < 1 && $min > 1){
            $runtime = $min. " min";
        }elseif($hours > 1 && $min < 1){
            $runtime = $hours." h ";
        }elseif($hours > 1 && $min <= 9){
            $runtime = $hours." h ". "0" .$min. " min";
        }else{
            $runtime = $hours." h ".$min. " min";
        }
    
              return $runtime;

        }


    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getDecade(): ?int
    {
        return $this->decade;
    }

    public function setDecade(?int $decade): self
    {
        $decade = substr($this->sortie, 0, 3) . 0;

        $this->decade = $decade;

        return $this;
    }

    public function getSortie(): ?int
    {
        return $this->sortie;
    }

    public function setSortie(?int $sortie): self
    {
        $this->sortie = $sortie;
        
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Marque[]
     */
    public function getMarques(): Collection
    {
        $marques = new ArrayCollection();
        if ($this->getCamera()){
            // @todo Gerer les doublons
           foreach($this->getCamera() as $camera){
               if($camera->getMarque()){
                   $marques->add($camera->getMarque());
               }
           }
        }
        return $marques;
    }
   
    public function removeMarques(Camera $camera)
    {
        $marques = new ArrayCollection();
        if ($this->removeCamera($camera)){
            // @todo Gerer les doublons
           foreach($this->removeCamera($camera) as $cam){
               if($cam->removeMarque()){
                   $marques->remove($cam->removeMarque());
               }
           }
        }
        return $marques;
    }



    

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function toDecade($sortie)
    {
        $decade = round($sortie/10, 0, PHP_ROUND_HALF_DOWN)* 10;
        return $decade;
    }

    /**
     * @return Collection|Modele[]
     */
    public function getModeles(): Collection
    {
        $modeles = new ArrayCollection();
        if ($this->getCamera()){
            // @todo Gerer les doublons
           foreach($this->getCamera() as $camera){
               if($camera->getModele()){
                   $modeles->add($camera->getModele());
               }
           }
        }
        return $modeles;
    }
    // public function removeModeles(Modele $modeles)
    // {
    //     // $modeles = new ArrayCollection();
    //     if ($this->removeCamera($camera)){
    //         // @todo Gerer les doublons
    //        foreach($this->getCamera() as $cam){
    //            if($cam->removeMarque()){
    //                $marques->remove($cam->removeMarque());
    //            }
    //        }
    //     }
    //     return $marques;
    // }

  
    /**
     * Get
     * @return null|File
     
     */ 
    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }

    /**
     * Set /*
     *@param null|File
     * @return  self
     */ 
    public function setPosterFile(?File $posterFile)
    {
        $this->posterFile = $posterFile;

        if($posterFile) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    /**
     * Get the value of poster
     */ 
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set the value of poster
     *
     * @return  self
     */ 
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return Collection|Director[]
     */
    public function getDirectors(): Collection
    {
        return $this->directors;
    }

    public function addDirector(Director $director): self
    {
        if (!$this->directors->contains($director)) {
            $this->directors[] = $director;
        }

        return $this;
    }

    public function removeDirector(Director $director): self
    {
        $this->directors->removeElement($director);

        return $this;
    }

 

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    // public function setCreatedAt(\DateTimeInterface $createdAt): self
    // {
    //     $this->createdAt = $createdAt;

    //     return $this;
    // }

    /**
     * @return Collection|Dirphoto[]
     */
    public function getDirphoto(): Collection
    {
        return $this->dirphoto;
    }

    public function addDirphoto(Dirphoto $dirphoto): self
    {
        if (!$this->dirphoto->contains($dirphoto)) {
            $this->dirphoto[] = $dirphoto;
        }

        return $this;
    }

    public function removeDirphoto(Dirphoto $dirphoto): self
    {
        $this->dirphoto->removeElement($dirphoto);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

   

    /**
     * Get the value of updatedAt
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return Collection|Pays[]
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): self
    {
        if (!$this->pays->contains($pay)) {
            $this->pays[] = $pay;
        }

        return $this;
    }

    public function removePay(Pays $pay): self
    {
        $this->pays->removeElement($pay);

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
        }
        // $this->camera->add($camera);
        return $this;
    }

    public function removeCamera(Camera $camera): self
    {
        $this->camera->removeElement($camera);

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

    public function getVideolink(): ?string
    {
        return $this->videolink;
    }

    public function setVideolink(?string $videolink): self
    {
        $this->videolink = $videolink;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getCaptchaCode()
    {
      return $this->captchaCode;
    }
  
    public function setCaptchaCode($captchaCode)
    {
      $this->captchaCode = $captchaCode;
    }

    
}
