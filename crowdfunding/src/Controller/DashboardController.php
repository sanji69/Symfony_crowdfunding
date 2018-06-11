<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Twig\Environment;
use App\Entity\Users;
use App\Entity\Contributor;
use App\Entity\Articles;


class DashboardController {

    /**
     * @Route("/admin", name="dashboard", methods={"GET", "POST"})
     */
    public function index(Environment $twig, ObjectManager $manager) {


        //recupération des
        $users = $manager->getRepository(Users::class);

        //passé utilisateur en admin

        //recupération des articles
        $articles = $manager->getRepository(Articles::class);

        // récupération des transaction
        $conts = $manager->getRepository(Contributor::class);

        //activé articles

        return new Response($twig->render('dashboard/dashboard.html.twig', array(
            'users'=>$users,
            'articles'=>$articles,
            'conts'=>$conts
        )));
    }
}
