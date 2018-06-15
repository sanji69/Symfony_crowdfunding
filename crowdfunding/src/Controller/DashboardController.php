<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Entity\Users;
use App\Entity\Articles;
use App\Entity\Contributor;


class DashboardController extends AbstractController
{

    /**
     * @Route("/admin", name="dashboard", methods={"GET", "POST"})
     */
    public function index(Environment $twig, EntityManagerInterface $em)
    {


        //recupération des users
        $users = $em->getRepository(Users::class)->findAll();

        //passé utilisateur en admin

//        $produits = $em->getRepository(Articles::class)->dede();
//        die($produits);

        //recupération des articles
        $articles = $em->getRepository(Articles::class)->findAll();

        // récupération des transaction
        $conts = $em->getRepository(Contributor::class)->findAll();

        //activé articles

        return $this->render('dashboard/dashboard.html.twig', [
            'users'=>$users,
            'articles'=>$articles,
            'conts'=>$conts,
        ]);
    }
}
