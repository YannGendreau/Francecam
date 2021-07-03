<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints as CaptchaAssert;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{

    /**
   * @Assert\Length(
   *      min = 2,
   *      max = 20,
   *      minMessage = "Le nom doit comporter au moins {{ limit }} caractères",
   *      maxMessage = "Le nom doit comporter au maximum {{ limit }} caractères"
   * )
   */
  protected $nom;

  /**
   * @Assert\Email(
   *      message = "L'email '{{ value }}' n'est pas un email valide.",
   * )
   */
  protected $email;


  /**
   * @Assert\Length(
   *      min = 2,
   *      max = 500,
   *      minMessage = "Le message doit comporter au moins {{ limit }} caractères",
   *      maxMessage = "Le message doit comporter au maximum {{ limit }} caractères"
   * )
   */
  protected $message;

  /**
   * @CaptchaAssert\ValidCaptcha(
   *      message = "CAPTCHA a échoué, tentez à nouveau."
   * )
   */
  protected $captchaCode;

  public function getCaptchaCode()
  {
    return $this->captchaCode;
  }

  public function setCaptchaCode($captchaCode)
  {
    $this->captchaCode = $captchaCode;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function setNom($nom)
  {
    $this->nom = $nom;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getSubject()
  {
    return $this->subject;
  }

  public function setSubject($subject)
  {
    $this->subject = $subject;
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function setMessage($message)
  {
    $this->message = $message;
  }

}
