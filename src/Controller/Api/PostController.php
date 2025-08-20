<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

final class PostController extends AbstractController
{
    #[Route('/api/post', name: 'app_api_post')]
    public function index(): Response
    {
        return $this->render('api/post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/api/post', name: 'app_api_post_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent(), true);
        $post = new \App\Entity\Post();
        $post->setTitle($data['title'] ?? '');
        $post->setContent($data['content'] ?? '');
        $post->setCreatedAt(new \DateTime());
        $em->persist($post);
        $em->flush();
        return $this->json([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'createdAt' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
        ]);
    }
}
