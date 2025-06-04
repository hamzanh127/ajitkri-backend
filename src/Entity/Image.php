<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]
#[ApiResource(
    normalizationContext: ['groups' => ['image:read']],
    denormalizationContext: ['groups' => ['image:write']],
    inputFormats: ['multipart' => ['multipart/form-data']]
)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['image:read', 'voiture:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['image:read', 'voiture:read'])]
    private ?string $fileName = null;

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'filename')]
    #[Groups(['image:write'])]
    private ?File $file = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    /**
     * @var Collection<int, Voiture>
     */
    #[ORM\OneToMany(targetEntity: Voiture::class, mappedBy: 'image')]
    private Collection $voitures;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
    }


    public function setFile(?File $file = null): void
    {
        $this->file = $file;

        if ($file !== null) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFile(): ?File
    {
        return $this->file;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voiture $voiture): static
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures->add($voiture);
            $voiture->setImage($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): static
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getImage() === $this) {
                $voiture->setImage(null);
            }
        }

        return $this;
    }

    
}
