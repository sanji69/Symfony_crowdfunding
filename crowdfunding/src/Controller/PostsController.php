<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends Controller
{
    /**
     * @Route("/posts", name="posts")
     */
    public function index(RegistryInterface $postRepository)
    {
        $posts = $postRepository->getRepository(Post::class)->findAll();
        return $this->render('posts/index.html.twig', compact('posts'));
    }
}
