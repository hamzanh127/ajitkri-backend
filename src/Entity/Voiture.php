<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
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
    inputFormats: ['multipart' => ['multipart/form-data']]
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
    private ?string $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?string $description = null;

    

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[Groups(['voiture:read', 'voiture:write'])]
    private ?Marque $marque = null;

    #[ORM\Column(length: 255, nullable: true)]
#[Groups(['voiture:read'])]
private ?string $image = null;

#[Vich\UploadableField(mapping: 'Voitures', fileNameProperty: 'image')]
#[Groups(['voiture:write'])]
private ?File $imageFile = null;

#[ORM\Column(type: 'datetime', nullable: true)]
private ?\DateTimeInterface $updatedAt = null;
 
public function setImageFile(?File $imageFile = null): void
{
    $this->imageFile = $imageFile;

    if ($imageFile !== null) {
        $this->updatedAt = new \DateTimeImmutable();
    }
}

    public function getImageFile(): ?File
    {
        return $this->imageFile;
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
