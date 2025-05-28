<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['voiture:read']],
    denormalizationContext: ['groups' => ['voiture:write']]
)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['voiture:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?Modele $modele = null;

    #[ORM\Column]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?int $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?Marque $marque = null;

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

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;

        return $this;
    }
}
