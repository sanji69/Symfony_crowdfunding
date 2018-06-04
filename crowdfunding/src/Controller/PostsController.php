<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request, Environment $twig, RegistryInterface $doctrine, FormFactoryInterface $formFactory)
    {
        $posts = $doctrine->getRepository(Post::class)->findAll();
        $form = $formFactory->createBuilder(PostType::class, $posts)->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $doctrine->getEntityManager()->flush();
        }

        return new Response($twig->render('posts/index.html.twig',[
            'posts' => $posts,
            'form' => $form->createView()
        ]));
    }
}
