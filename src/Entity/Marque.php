<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['marque:read']],
    denormalizationContext: ['groups' => ['marque:write']],
     operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),
    ]
)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['marque:read', 'voiture:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['marque:read', 'marque:write', 'voiture:read','modele:marque-read'])]
    private ?string $nom = null;

    /**
     * @var Collection<int, Modele>
     */
    #[ORM\OneToMany(targetEntity: Modele::class, mappedBy: 'marque')]
    
    private Collection $modeles;

    /**
     * @var Collection<int, Voiture>
     */
    #[ORM\OneToMany(targetEntity: Voiture::class, mappedBy: 'marque')]
    #[MaxDepth(2)]
    private Collection $voitures;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
        $this->voitures = new ArrayCollection();
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

    /**
     * @return Collection<int, Modele>
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): static
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles->add($modele);
            $modele->setMarque($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): static
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getMarque() === $this) {
                $modele->setMarque(null);
            }
        }

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
            $voiture->setMarque($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): static
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getMarque() === $this) {
                $voiture->setMarque(null);
            }
        }

        return $this;
    }
}
