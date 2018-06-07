<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('dashboard/dashboard.html.twig');
    }
}
