<?php
// src/EventSubscriber/UserPasswordHasherSubscriber.php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPasswordHasherSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    /**
     * Retourne les événements auxquels ce subscriber écoute.
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    /**
     * Cette méthode est appelée avant qu'une entité soit créée (persistée).
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof User) {
            return;
        }

        $this->hashPassword($entity);
    }

    /**
     * Cette méthode est appelée avant qu'une entité soit mise à jour.
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof User) {
            return;
        }

        $this->hashPassword($entity);
    }

    /**
     * Hache le mot de passe de l'utilisateur si un nouveau mot de passe a été fourni.
     */
    private function hashPassword(User $user): void
    {
        $plainPassword = $user->getPlainPassword();

        if (empty($plainPassword)) {
            return;
        }

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plainPassword
        );
        $user->setPassword($hashedPassword);
        // Il est important de ne pas stocker le mot de passe en clair.
        $user->eraseCredentials();
    }
}
