<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonRepository")
 */
class Season
{
    use TimestampableEntity;
    use ArchivedTraits;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $season_year;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="season")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonYear(): ?string
    {
        return $this->season_year;
    }

    public function setSeasonYear(string $season_year): self
    {
        $this->season_year = $season_year;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }
}
