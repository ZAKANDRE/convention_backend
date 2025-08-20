<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    #[Route('/api/post', name: 'app_api_post')]
    public function index(): Response
    {
        return $this->render('api/post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }
}
