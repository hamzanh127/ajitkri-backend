<?php

namespace App\DataTransformer;

use ApiPlatform\Dto\DtoInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\VoitureInput;
use App\Entity\Voiture;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class VoitureInputDataTransformer implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private MarqueRepository $marqueRepo,
        private ModeleRepository $modeleRepo,
        private SluggerInterface $slugger,
        private ProcessorInterface $persistProcessor
    ) {}

    public function supports(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): bool
    {
        return $data instanceof VoitureInput;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $voiture = new Voiture();
        $voiture->setNom($data->nom);
        $voiture->setPrix($data->prix);
        $voiture->setDescription($data->description);

        if ($data->marque) {
            $marque = $this->em->getReference('App\Entity\Marque', $this->extractId($data->marque));
            $voiture->setMarque($marque);
        }

        if ($data->modele) {
            $modele = $this->em->getReference('App\Entity\Modele', $this->extractId($data->modele));
            $voiture->setModele($modele);
        }

        if ($data->file instanceof UploadedFile) {
            $originalFilename = pathinfo($data->file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $data->file->guessExtension();

            $data->file->move('uploads/voitures', $newFilename); // à adapter
            $voiture->setImage($newFilename); // Assure-toi que `setImage()` existe dans ton entité
        }

        return $this->persistProcessor->process($voiture, $operation, $uriVariables, $context);
    }

    private function extractId(string $iri): ?int
    {
        if (preg_match('#/(\d+)$#', $iri, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }
}
