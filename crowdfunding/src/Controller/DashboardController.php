<?php

namespace App\Controller;

use App\Entity\Users;
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

        $user = $em->getRepository(Users::class)->findAll();


        return $this->render('dashboard/dashboard.html.twig', [
            'articles'=>$articles,
            'conts'=>$conts,
            'users'=>$user,
        ]);
    }

    /**
     * @Route("/setadmin/{id}", name="set_admin", methods={"GET", "POST"})
     */
    public function  setAdminAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em
            ->getRepository(Users::class)
            ->find($id);

        $users->setRoles('ROLE_ADMIN');
        $em->persist($users);
        $em->flush();

        return $this->redirectToRoute("dashboard");

    }

    /**
 * @Route("/setuser/{id}", name="set_user", methods={"GET", "POST"})
 */
    public function  setUserAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em
            ->getRepository(Users::class)
            ->find($id);

        $users->setRoles('ROLE_USER');
        $em->persist($users);
        $em->flush();

        return $this->redirectToRoute("dashboard");

    }
}

