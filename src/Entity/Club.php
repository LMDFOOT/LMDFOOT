<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedTraits;
use App\Entity\Traits\PublishedTraits;
use App\Entity\Traits\TimestampableTraits;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClubRepository")
 */
class Club
{
    use TimestampableTraits;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $abbreviation;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="id_club")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClubTeam", mappedBy="club")
     */
    private $clubTeams;


    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->clubTeams = new ArrayCollection();
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

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addClub($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            $article->removeClub($this);
        }

        return $this;
    }

    /**
     * @return Collection|ClubTeam[]
     */
    public function getClubTeams(): Collection
    {
        return $this->clubTeams;
    }

    public function addClubTeam(ClubTeam $clubTeam): self
    {
        if (!$this->clubTeams->contains($clubTeam)) {
            $this->clubTeams[] = $clubTeam;
            $clubTeam->setClub($this);
        }

        return $this;
    }

    public function removeClubTeam(ClubTeam $clubTeam): self
    {
        if ($this->clubTeams->contains($clubTeam)) {
            $this->clubTeams->removeElement($clubTeam);
            // set the owning side to null (unless already changed)
            if ($clubTeam->getClub() === $this) {
                $clubTeam->setClub(null);
            }
        }

        return $this;
    }
}
