<?php

namespace App\Controller;

use App\Form\ArticlesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Articles;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ArticlesController extends Controller
{

    /**
    * @Route("/", name="index")
    */
    public function indexAction()
    {
       //Appel de l'entity Manager
        $em = $this->getDoctrine()->getManager();
        $articles = $em
            ->getRepository(Articles::class)
            ->findAll();
        return $this->render("articles/index.html.twig", [
            "articles" => $articles
        ]);
    }

    /**
     * @Route("/add", name="creer_articles", methods={"GET", "POST"})
     */
    public function createAction(Request $request)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user_id = $this
                ->getUser()
                ->getId()
            ;

        //Instance de l'entité
        $article = new Articles;

        $article->setUser($user_id);
        $article->setActived(0);


        //Création du formulaire
        $form = $this->createForm(ArticlesType::class, $article);

        $form->handleRequest($request);

        //Récupération des données du formulaire
        if ($form->isSubmitted() && $form->isValid())
        {
            //Appel de l'Entity Manager et envoi en base de donnée
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();


            //Redirection
            return $this->redirectToRoute("articles/retrieve.html.twig", [
                "title"=>$article->getTitle(),
                "id"=>$article->getId()
            ]);
        }

        //Envois du formulaire au fichier de vue
        return $this->render("articles/add.html.twig", array(
            "form"=>$form->createView()
        ));


    }

    /**
     * @Route("/modify", name="modifier_articles", methods={"GET", "POST"})
     */
    public function modifyAction(Request $request)
    {
        $articles = new Articles;
        $form = $this->createForm(ArticlesType::class, $articles);

        if($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'artile updated');
        }

        return $this->render('articles/modify.html.twig');
    }

    /**
     * @Route("/retrieve", name="mon_articles", methods={"GET"})
     */
    public function retrieveAction($title, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em
            ->getRepository(Articles::class)
            ->find($id);

        return $this->render('articles/retrieve.html.twig', [
            "article" => $article
        ]);
    }

    /**
     * @Route("/erase", name="supprimer_articles", methods={"GET"})
     */
    public function eraseAction()
    {
        //doctrine -> actived = 0 -> envoi requete
        // redirection index
        return $this->render('articles/erase.html.twig');
    }

    /**
     * @Route("/search", name="ma_recherche", methods={"GET"})
     */
    public function searchAction()
    {
        //-> recherhe dans la bdd requete composé

        // -> $request = "SELECT * FROM articles WHERE title = ";
        // -> $search = %recherche%;
        // -> $request = $request.$search." OR content = ".$search;

        return $this->render('articles/search.html.twig');
    }
}
