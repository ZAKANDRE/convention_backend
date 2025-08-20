<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: User::class)]
    private Collection $users;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $sigle = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();  // Инициализируем коллекцию
    }

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

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): static
    {
        $this->sigle = $sigle;

        return $this;
    }

    // Добавляем геттер для пользователей
    public function getUsers(): Collection
    {
        return $this->users;
    }

    // Добавляем метод для добавления пользователя
    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setFormation($this); // Обновляем связь с Formation в User
        }

        return $this;
    }

    // Добавляем метод для удаления пользователя
    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // Снимаем связь в User, если она указывает на этот Formation
            if ($user->getFormation() === $this) {
                $user->setFormation(null);
            }
        }

        return $this;
    }
}
