<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeagueRepository::class)
 */
class League
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="league")
     */
    private $player;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->player = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(User $player): self
    {
        if (!$this->player->contains($player)) {
            $this->player[] = $player;
            $player->setLeague($this);
        }

        return $this;
    }

    public function removePlayer(User $player): self
    {
        if ($this->player->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getLeague() === $this) {
                $player->setLeague(null);
            }
        }

        return $this;
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
}
