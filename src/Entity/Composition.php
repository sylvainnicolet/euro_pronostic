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

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_2;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_3;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_4;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_5;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_6;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_7;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_8;

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

    public function getTeam2(): ?Team
    {
        return $this->team_2;
    }

    public function setTeam2(?Team $team_2): self
    {
        $this->team_2 = $team_2;

        return $this;
    }

    public function getTeam3(): ?Team
    {
        return $this->team_3;
    }

    public function setTeam3(?Team $team_3): self
    {
        $this->team_3 = $team_3;

        return $this;
    }

    public function getTeam4(): ?Team
    {
        return $this->team_4;
    }

    public function setTeam4(?Team $team_4): self
    {
        $this->team_4 = $team_4;

        return $this;
    }

    public function getTeam5(): ?Team
    {
        return $this->team_5;
    }

    public function setTeam5(?Team $team_5): self
    {
        $this->team_5 = $team_5;

        return $this;
    }

    public function getTeam6(): ?Team
    {
        return $this->team_6;
    }

    public function setTeam6(?Team $team_6): self
    {
        $this->team_6 = $team_6;

        return $this;
    }

    public function getTeam7(): ?Team
    {
        return $this->team_7;
    }

    public function setTeam7(?Team $team_7): self
    {
        $this->team_7 = $team_7;

        return $this;
    }

    public function getTeam8(): ?Team
    {
        return $this->team_8;
    }

    public function setTeam8(?Team $team_8): self
    {
        $this->team_8 = $team_8;

        return $this;
    }
}
