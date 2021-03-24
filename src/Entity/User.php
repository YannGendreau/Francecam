<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert; 
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="users")
 * @UniqueEntity(
 * *     fields={"email"},
 *       message="Vous êtes déjà enregistré"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email(message="Entrez une adresse Email")
     * @Assert\NotBlank(message="Veuillez saisir une adresse Email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Film::class, mappedBy="user")
     */
    private $film;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    // /**
    //  * @ORM\Column(type="boolean", nullable=true)
    //  */
    // private $isVerified;

    public function __construct()
    {
        $this->film = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

     /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @see UserInterface
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

   

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @see UserInterface
     */
    public function getSalt()
    {
        //Pas utilisé si un meilleur encrypteur est appelé.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @see UserInterface
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

  public function __toString()
  {
      return $this->name; $this->createdAt;
     
  }
 

  /**
   * @return Collection|Film[]
   */
  public function getFilm(): Collection
  {
      return $this->film;
  }

  public function addFilm(Film $film): self
  {
      if (!$this->film->contains($film)) {
          $this->film[] = $film;
          $film->setUser($this);
      }

      return $this;
  }

  public function removeFilm(Film $film): self
  {
      if ($this->film->removeElement($film)) {
          // set the owning side to null (unless already changed)
          if ($film->getUser() === $this) {
              $film->setUser(null);
          }
      }

      return $this;
  }

  public function getCreatedAt(): ?\DateTimeInterface
  {
      return $this->createdAt;
  }

//   public function setCreatedAt(\DateTimeInterface $createdAt): self
//   {
//       $this->createdAt = $createdAt;

//       return $this;
//   }

  public function getUpdatedAt(): ?\DateTimeInterface
  {
      return $this->updatedAt;
  }

//   public function setUpdatedAt(\DateTimeInterface $updatedAt): self
//   {
//       $this->updatedAt = $updatedAt;

//       return $this;
//   }

  public function getIsVerified(): ?bool
  {
      return $this->isVerified;
  }

  public function setIsVerified(bool $isVerified): self
  {
      $this->isVerified = $isVerified;

      return $this;
  }
}
