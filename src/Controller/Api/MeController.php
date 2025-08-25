<?php
// src/Controller/Api/MeController.php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MeController extends AbstractController
{
    #[Route('/api/me', name: 'api_get_me', methods: ['GET', 'OPTIONS'])] // J'ai ajouté OPTIONS pour la compatibilité CORS
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function __invoke(#[CurrentUser] ?User $user): JsonResponse
    {
        // ...

        // ✅ CORRECTION : Ajoutez le contexte de sérialisation ici
        return $this->json($user, 200, [], ['groups' => 'user:read']);
    }
}