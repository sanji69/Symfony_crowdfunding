<?php

namespace App\Controller;

use App\Form\ArticlesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Entity\Articles;
use App\Entity\Contributor;


class DashboardController extends AbstractController
{

    /**
     * @Route("/admin", name="dashboard", methods={"GET", "POST"})
     */
    public function index(Environment $twig, EntityManagerInterface $em, Request $request)
    {

        //recupération des articles
        $articles = $em->getRepository(Articles::class)->findAll();

        // récupération des transaction
        $conts = $em->getRepository(Contributor::class)->findAll();

        $form = $this->createForm(ArticlesType::class, $articles);


        //activé articles
//        if($form->handleRequest($request)->isSubmitted())
//        {
//            $em = $this->getDoctrine()->getManager();
//
//            $articles->setActived(1);
//            $em->persist($articles);
//
//            $em->flush();
//        }
//        $form = $form->createView();


        return $this->render('dashboard/dashboard.html.twig', [
            'articles'=>$articles,
            'conts'=>$conts,
        ]);
    }
}
