<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['people:read']],
    denormalizationContext: ['groups' => ['people:write']]
)]
#[ORM\Entity]
class People
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['people:read', 'movie:read'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['people:read', 'people:write', 'movie:read'])]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['people:read', 'people:write', 'movie:read'])]
    private $lastname;

    #[ORM\Column(type: 'date')]
    #[Groups(['people:read', 'people:write', 'movie:read'])]
    private $dateOfBirth;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['people:read', 'people:write', 'movie:read'])]
    private $nationality;

    #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'people')]
    #[Groups(['people:read', 'people:write'])]
    private $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->addPerson($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            $movie->removePerson($this);
        }

        return $this;
    }
}