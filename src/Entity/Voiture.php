<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: VoitureRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['voiture:read']],
    denormalizationContext: ['groups' => ['voiture:write']],
    operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),
    ]
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

    

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?Image $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?string $transmission = null;

   
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

   

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(?string $transmission): static
    {
        $this->transmission = $transmission;

        return $this;
    }

}
