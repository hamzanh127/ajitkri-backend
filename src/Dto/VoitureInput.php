<?php
namespace App\Dto;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;

class VoitureInput
{
    #[Groups(['voiture:write'])]
    public ?string $nom = null;

    #[Groups(['voiture:write'])]
    public ?int $prix = null;

    #[Groups(['voiture:write'])]
    public ?string $description = null;

    #[Groups(['voiture:write'])]
    public ?string $modele = null;  // ici on récupère l’IRI du modèle

    #[Groups(['voiture:write'])]
    public ?string $marque = null;  // IRI de la marque

    #[Groups(['voiture:write'])]
    public ?UploadedFile $file = null;
}

