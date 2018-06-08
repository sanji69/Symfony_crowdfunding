<?php

namespace App\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticlesController extends Controller
{

    /**
    * @Route("/", name="index")
    */
    public function index()
    {
        return $this->render('articles/index.html.twig');
    }

    /**
     * @Route("/add", name="creer_articles")
     */
    public function create()
    {
        return $this->render('articles/add.html.twig');
    }
}
