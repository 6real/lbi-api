<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="movie_has_type")
 */
class MovieHasType
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Movie::class)
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id", nullable=false)
     */
    private $movie;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Type::class)
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    private $type;

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}