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
        // afficher les 8 derniers articles
        return $this->render('articles/index.html.twig');
    }

    /**
     * @Route("/add", name="creer_articles", methods={"GET", "POST"})
     */
    public function create()
    {
        //formulaire de création
        //injection en base de donnée (doctrine)
        //redirection vers retrieve -> article
        return $this->render('articles/add.html.twig');
    }

    /**
     * @Route("/modify", name="modifier_articles, methods={"GET", "POST"}")
     */
    public function modify()
    {
        // recupération de l'article
        //formulaire de modification remplis
        //injection en base de donnée (doctrine)
        //redirection vers retrieve -> article
        return $this->render('articles/modify.html.twig');
    }

    /**
     * @Route("/retrieve", name="mon_articles", methods={"GET"})
     */
    public function retrieve()
    {
        // récupération de l'article
        // affichage de l'article

        // -> title
        // -> content
        // -> auteur
        // -> status/goal

        return $this->render('articles/retrieve.html.twig');
    }

    /**
     * @Route("/erase", name="supprimer_articles", methods={"GET"})
     */
    public function erase()
    {
        //doctrine -> actived = 0 -> envoi requete
        // redirection index
        return $this->render('articles/erase.html.twig');
    }

    /**
     * @Route("/search", name="ma_recherche", methods={"GET"})
     */
    public function search()
    {
        //-> recherhe dans la bdd requete composé

        // -> $request = "SELECT * FROM articles WHERE title = ";
        // -> $search = %recherche%;
        // -> $request = $request.$search." OR content = ".$search;

        return $this->render('articles/search.html.twig');
    }
}
