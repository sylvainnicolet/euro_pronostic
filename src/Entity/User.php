<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
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
   * @ORM\Column(type="string", length=180, unique=true)
   */
  private $username;

  /**
   * @ORM\Column(type="json")
   */
  private $roles = [];

  /**
   * @var string The hashed password
   * @ORM\Column(type="string")
   */
  private $password;

  /**
   * @ORM\OneToOne(targetEntity=Composition::class, mappedBy="player", cascade={"persist", "remove"})
   */
  private $composition;

  /**
   * @ORM\ManyToOne(targetEntity=League::class, inversedBy="player")
   */
  private $league;

  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * A visual identifier that represents this user.
   *
   * @see UserInterface
   */
  public function getUsername(): string
  {
    return (string) $this->username;
  }

  public function setUsername(string $username): self
  {
    $this->username = $username;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function getRoles(): array
  {
    $roles = $this->roles;

    return array_unique($roles);
  }

  public function setRoles(array $roles): self
  {
    $this->roles = $roles;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function getPassword(): string
  {
    return (string) $this->password;
  }

  public function setPassword(string $password): self
  {
    $this->password = $password;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function getSalt()
  {
    // not needed when using the "bcrypt" algorithm in security.yaml
  }

  /**
   * @see UserInterface
   */
  public function eraseCredentials()
  {
    // If you store any temporary, sensitive data on the user, clear it here
    // $this->plainPassword = null;
  }

  public function getComposition(): ?Composition
  {
      return $this->composition;
  }

  public function setComposition(Composition $composition): self
  {
      // set the owning side of the relation if necessary
      if ($composition->getPlayer() !== $this) {
          $composition->setPlayer($this);
      }

      $this->composition = $composition;

      return $this;
  }

  public function getLeague(): ?League
  {
      return $this->league;
  }

  public function setLeague(?League $league): self
  {
      $this->league = $league;

      return $this;
  }

  public function getSlug() : string {
    return (new Slugify())->slugify($this->username);
  }
}
