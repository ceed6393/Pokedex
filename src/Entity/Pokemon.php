<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "veuillez saisir un nom")]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "veuillez saisir une description")]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\Type(
        type: 'integer',
        message: 'L attaque {{ value }} n est pas valide {{ type }}.',
    )]
    private ?int $attaque = null;

    #[ORM\Column]
    #[Assert\Type(
        type: 'integer',
        message: 'La défense {{ value }} n est pas valide {{ type }}.',
    )]
    private ?int $defense = null;

    #[ORM\Column]
    #[Assert\Type(
        type: 'integer',
        message: 'Les points de vie {{ value }} ne sont pas valides {{ type }}.',
    )]
    private ?int $point_de_vie = null;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'pokemon')]
    private Collection $Type;

    #[Orm\Column(nullable: false)]
    private ?string $picture = null;


    public function __construct()
    {
        $this->Type = new ArrayCollection();
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAttaque(): ?int
    {
        return $this->attaque;
    }

    public function setAttaque(int $attaque): static
    {
        $this->attaque = $attaque;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): static
    {
        $this->defense = $defense;

        return $this;
    }

    public function getPointDeVie(): ?int
    {
        return $this->point_de_vie;
    }

    public function setPointDeVie(int $point_de_vie): static
    {
        $this->point_de_vie = $point_de_vie;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getType(): Collection
    {
        return $this->Type;
    }

    public function addType(Type $type): static
    {
        if (!$this->Type->contains($type)) {
            $this->Type->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->Type->removeElement($type);

        return $this;
    }
}
