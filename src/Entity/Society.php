<?php

namespace App\Entity;

use App\Repository\SocietyRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: SocietyRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'convention:item']),
        new GetCollection(normalizationContext: ['groups' => 'convention:list']),
        new Post(),
        new Patch(),
        new Delete(),
    ],
    order: ['id' => 'DESC'],
    paginationEnabled: false,
)]
class Society
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['society:list', 'society:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['convention:list', 'convention:item'])]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    #[Groups(['convention:list', 'convention:item'])]
    private ?string $adresse = null;

    #[ORM\Column]
    #[Groups(['convention:list', 'convention:item'])]
    private ?int $siren = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSiren(): ?int
    {
        return $this->siren;
    }

    public function setSiren(int $siren): static
    {
        $this->siren = $siren;

        return $this;
    }
}
