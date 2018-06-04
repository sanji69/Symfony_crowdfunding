<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class PostsController extends Controller
{
    /**
     * @Route("/posts", name="posts")
     */
    public function index(Environment $twig, RegistryInterface $doctrine, FormFactoryInterface $formFactory)
    {
        $posts = $doctrine->getRepository(Post::class)->findAll();
        $form = $formFactory->createBuilder(PostType::class, $posts)->getForm();

        return new Response($twig->render('posts/index.html.twig',[
            'posts' => $posts,
            'form' => $form->createView()
        ]));
    }
}
