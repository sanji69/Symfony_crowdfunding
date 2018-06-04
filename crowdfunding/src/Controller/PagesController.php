<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PagesController
{

    /**
    *   @Route ("/")
    *   @param Environment $twig
    *   @return Response
    *   @throws \Twig_Error_Loader
    *   @throws \Twig_Error_Runtime
    *   @throws \Twig_Error_Syntax
    */
    public function index(Environment $twig)
    {
        return new Response($twig->render('pages/welcome.html.twig'));
    }
}
