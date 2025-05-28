<?php

namespace App\Serializer;

use App\Dto\VoitureInput;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class MultipartFormDataDenormalizer implements DenormalizerInterface
{
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $format === 'multipart' && $type === VoitureInput::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $dto = new VoitureInput();

        $dto->nom = $data['nom'] ?? null;
        $dto->prix = isset($data['prix']) ? (int) $data['prix'] : null;
        $dto->description = $data['description'] ?? null;
        $dto->modele = $data['modele'] ?? null;
        $dto->marque = $data['marque'] ?? null;
        $dto->file = $data['file'] ?? null;

        return $dto;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            VoitureInput::class => $format === 'multipart',
        ];
    }
}
