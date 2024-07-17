<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['movie:read']],
    denormalizationContext: ['groups' => ['movie:write']]
)]
#[ORM\Entity]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['movie:read', 'type:read', 'people:read'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['movie:read', 'movie:write', 'type:read', 'people:read'])]
    private $title;

    #[ORM\Column(type: 'integer')]
    #[Groups(['movie:read', 'movie:write'])]
    private $duration;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'movies')]
    #[ORM\JoinTable(name: 'movie_has_type')]
    #[Groups(['movie:read', 'movie:write'])]
    private $types;

    #[ORM\ManyToMany(targetEntity: People::class, inversedBy: 'movies')]
    #[ORM\JoinTable(name: 'movie_has_people')]
    #[Groups(['movie:read', 'movie:write'])]
    private $people;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->people = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection|Type[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPerson(People $person): self
    {
        if (!$this->people->contains($person)) {
            $this->people[] = $person;
        }

        return $this;
    }

    public function removePerson(People $person): self
    {
        $this->people->removeElement($person);

        return $this;
    }
}