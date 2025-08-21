<?php

namespace App\Entity;

use App\Repository\ConventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Attribute\Groups;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: ConventionRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'convention:item']),
        new GetCollection(normalizationContext: ['groups' => 'convention:list']),
        new Post(),
        new Patch(),
        new Delete(),
    ],
    order: ['dateStart' => 'DESC'],
    paginationEnabled: false,
)]
class Convention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['convention:list', 'convention:item'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['convention:list', 'convention:item', 'convention:write'])]
    private ?int $studentId = null;

    #[ORM\Column]
    #[Groups(['convention:list', 'convention:item', 'convention:write'])]
    private ?int $commanderId = null;

    #[ORM\Column]
    #[Groups(['convention:list', 'convention:item', 'convention:write'])]
    private ?int $afpaDirectorId = null;

    #[ORM\Column]
    #[Groups(['convention:list', 'convention:item', 'convention:write'])]
    private ?int $formationId = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['convention:list', 'convention:item', 'convention:write'])]
    private ?\DateTime $dateStart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['convention:list', 'convention:item', 'convention:write'])]
    private ?\DateTime $dateEnd = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'conventions', cascade: ['persist'])]
    private Collection $users;

    #[ORM\ManyToOne(targetEntity: Society::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['convention:list', 'convention:item', 'convention:write'])]
    private ?Society $society = null;

    #[ORM\Column]
    #[Groups(['convention:list', 'convention:item', 'convention:write'])]
    private ?int $progress = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentId(): ?int
    {
        return $this->studentId;
    }

    public function setStudentId(int $studentId): static
    {
        $this->studentId = $studentId;
        return $this;
    }

    public function getCommanderId(): ?int
    {
        return $this->commanderId;
    }

    public function setCommanderId(int $commanderId): static
    {
        $this->commanderId = $commanderId;
        return $this;
    }

    public function getAfpaDirectorId(): ?int
    {
        return $this->afpaDirectorId;
    }

    public function setAfpaDirectorId(int $afpaDirectorId): static
    {
        $this->afpaDirectorId = $afpaDirectorId;
        return $this;
    }

    public function getFormationId(): ?int
    {
        return $this->formationId;
    }

    public function setFormationId(int $formationId): static
    {
        $this->formationId = $formationId;
        return $this;
    }

    public function getDateStart(): ?\DateTime
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTime $dateStart): static
    {
        $this->dateStart = $dateStart;
        return $this;
    }

    public function getDateEnd(): ?\DateTime
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTime $dateEnd): static
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }
        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);
        return $this;
    }

    public function getSociety(): ?Society
    {
        return $this->society;
    }

    public function setSociety(?Society $society): static
    {
        $this->society = $society;
        return $this;
    }

    public function getProgress(): ?int
    {
        return $this->progress;
    }

    public function setProgress(int $progress): static
    {
        $this->progress = $progress;
        return $this;
    }

    public function __toString(): string
    {
        return 'Convention #' . $this->id . ' (' . $this->dateStart?->format('Y-m-d') . ' → ' . $this->dateEnd?->format('Y-m-d') . ')';
    }
}
