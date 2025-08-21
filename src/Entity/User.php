<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
// ✅ AJOUTS IMPORTANTS
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'user:item']),
        new GetCollection(normalizationContext: ['groups' => 'user:list']),
        new Post(),
        new Patch(),
        new Delete(),
    ],
    // 'dateStart' n'existe pas dans votre entité, j'ai enlevé cette ligne pour éviter une erreur.
    // order: ['dateStart' => 'DESC'], 
    paginationEnabled: false,
)]
// ✅ AJOUTS IMPORTANTS : Implémentation des interfaces de sécurité
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:list', 'user:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['user:list', 'user:item'])]
    private ?string $first_name = null;

    #[ORM\Column(length: 100)]
    #[Groups(['user:list', 'user:item'])]
    private ?string $last_name = null;

    #[ORM\Column(length: 180, unique: true)] 
    #[Groups(['user:list', 'user:item'])]
    private ?string $email = null;

    #[ORM\Column] 
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    #[Groups(['user:list', 'user:item'])]
    private ?string $telephone = null;

    #[ORM\Column(length: 100)]
    #[Groups(['user:list', 'user:item'])]
    private ?string $matricule = null;

    /**
     * @var Collection<int, Convention>
     */
    #[ORM\ManyToMany(targetEntity: Convention::class, mappedBy: 'user')]
    private Collection $conventions;

    #[ORM\ManyToOne(targetEntity: Formation::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Formation $formation = null;
    
    // La propriété `$roles` a été supprimée.

    public function __construct()
    {
        $this->conventions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;
        return $this;
    }

    /**
     * @return Collection<int, Convention>
     */
    public function getConventions(): Collection
    {
        return $this->conventions;
    }

    public function addConvention(Convention $convention): static
    {
        if (!$this->conventions->contains($convention)) {
            $this->conventions->add($convention);
            $convention->addUser($this);
        }
        return $this;
    }

    public function removeConvention(Convention $convention): static
    {
        if ($this->conventions->removeElement($convention)) {
            $convention->removeUser($this);
        }
        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;
        return $this;
    }

    // ✅ ===================================================================
    // ✅ MÉTHODES REQUISES PAR LE SYSTÈME DE SÉCURITÉ DE SYMFONY
    // ✅ ===================================================================

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }


    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
  
    }
}