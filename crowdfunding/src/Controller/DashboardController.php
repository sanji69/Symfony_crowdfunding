<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class DashboardController {

    /**
     * @Route("/admin", name="dashboard", methods={"GET", "POST"})
     */
    public function index(Environment $twig) {


        //recupération des utilisateurs

        //passé utilisateur en admin

        //recupération des articles

        //activé articles

        return new Response($twig->render('dashboard/dashboard.html.twig'));
    }
}
