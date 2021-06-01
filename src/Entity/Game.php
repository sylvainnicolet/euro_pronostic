<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="games")
     */
    private $team_1;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="games")
     */
    private $team_2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score_1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score_2;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isGroupGame;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFinished;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getScore1(): ?int
    {
        return $this->score_1;
    }

    public function setScore1(?int $score_1): self
    {
        $this->score_1 = $score_1;

        return $this;
    }

    public function getScore2(): ?int
    {
        return $this->score_2;
    }

    public function setScore2(?int $score_2): self
    {
        $this->score_2 = $score_2;

        return $this;
    }

    public function getIsGroupGame(): ?bool
    {
        return $this->isGroupGame;
    }

    public function setIsGroupGame(bool $isGroupGame): self
    {
        $this->isGroupGame = $isGroupGame;

        return $this;
    }

    public function getIsFinished(): ?bool
    {
        return $this->isFinished;
    }

    public function setIsFinished(bool $isFinished): self
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
