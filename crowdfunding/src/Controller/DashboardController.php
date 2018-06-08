<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class DashboardController {

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(Environment $twig) {
        return new Response($twig->render('dashboard/dashboard.html.twig'));
    }
}
