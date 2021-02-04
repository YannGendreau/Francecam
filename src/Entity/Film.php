<?php

namespace App\Entity;

use App\Entity\Marque;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FilmRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert; 

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
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
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string",  length = 4, nullable = true)
     */
    private $decade;

    /**
     * @ORM\Column(type="integer")
     */
    private $sortie;

    /**
     * @ORM\ManyToMany(targetEntity=Marque::class, inversedBy="film", cascade={"all"})
     * 
     */
    private $marques;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;



    public function __construct()
    {
        $this->marque = new ArrayCollection();
        $this->marques = new ArrayCollection();
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



    

    public function getSortie(): ?int
    {
        return $this->sortie;
    }

    public function setSortie(int $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }

    public function getDecade(): ?string
    {
        return $this->decade;
    }

    public function setDecade(string $decade): self
    {
        
        // $this->decade = $decade;
        $this->decade = $decade;
        // $date = $this->sortie;
        // $dateStr = strval($date);
        // $decade = substr($dateStr ,1 ,3) . '0';
        // $this->decade = $decade;

        return $this;

        // return $decade;
    }

    /**
     * @return Collection|Marque[]
     */
    public function getMarques(): Collection
    {
        return $this->marques;
    }

    // public function addMarques(Marque $marque): self
    // {
    //     if (!$this->marques->contains($marque)) {
    //         $this->marques[] = $marque;
    //     }

    //     return $this;
    // }

    public function addMarque(Marque $marque): self
    {
        if (!$this->marques->contains($marque)) {
            $this->marques[] = $marque;
            $marque->addFilm($this);
        }

        return $this;
    }

    public function removeMarque(Marque $marque): self
    {
        if ($this->marques->removeElement($marque)) {
            $marque->removeFilm($this);
        }

        return $this;
    }

    public function toDecade(int $sortie): int
    {
        return substr($sortie, 1, 3) . 0;

        // return $decade;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

   
     // @ORM\ManyToMany(targetEntity=Marque::class, mappedBy="film", cascade={"all"})


}
