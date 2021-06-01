<?php

namespace App\Entity;

use App\Repository\CompositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompositionRepository::class)
 */
class Composition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="composition", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?User
    {
        return $this->player;
    }

    public function setPlayer(User $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getTeam1(): ?Team
    {
        return $this->team_1;
    }

    public function setTeam1(?Team $team_1): self
    {
        $this->team_1 = $team_1;

        return $this;
    }
}
