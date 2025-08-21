<?php
// src/Controller/SecurityController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @see https://symfony.com/doc/current/security/impersonating_user.html
     */
    // ✅ CORRECTION : Ajout de 'OPTIONS' à la liste des méthodes autorisées
    #[Route('/api/login_check', name: 'api_login_check', methods: ['POST', 'OPTIONS'])]
    public function loginCheck()
    {
        // Cette méthode peut être vide - elle ne sera jamais exécutée.
        // Le pare-feu de sécurité intercepte la requête avant.
        throw new \LogicException('This method can be blank - it will be intercepted by the login key on your firewall.');
    }
}
