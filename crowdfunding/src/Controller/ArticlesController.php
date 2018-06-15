<?php

namespace App\Controller;

use App\Form\ArticlesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Articles;


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

        $user= $this
                ->getUser()
            ;

        //Instance de l'entité
        $articles = new Articles;

        $articles->setUser($user);

        $articles->setActived(0);


        //Création du formulaire
        $form = $this->createForm(ArticlesType::class,  $articles);

        //$form->handleRequest($request);

        //Récupération des données du formulaire
        if ($form->isSubmitted() && $form->isValid())
        {

            //Appel de l'Entity Manager et envoi en base de donnée
            $em = $this->getDoctrine()->getManager();
            $em->persist($articles);
            $em->flush();

          


            //Redirection
            return $this->redirectToRoute("articles/modify.html.twig", [
                "title"=>$articles->getTitle(),
                "id"=>$articles->getId()
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
    public function modifyAction($title, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em
            ->getRepository('Articles')
            ->find($id);


            return $this->render("articles/modify.html.twig",
            ["article"=>$article]

             );
    }

    /**
     * @Route("/retrieve", name="mon_articles", methods={"GET"})
     */
    public function retrieveAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em
            ->getRepository(Articles::class)
            ->find($id);
        $form = $this->createForm(ArticlesType::class, $article);
        if($form->handleRequest($request)->isSubmitted())
        {
            $data =  $form->getData();

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('articles/modify.html.twig',
                [
                    "title"=>$article->getTile('title'),
                    "id"=>$article->getId('id')
                ]);
        }


        $form = $form->createView();
        return $this->render('articles/retrieve.html.twig', [
            "article" => $article
        ]);
    }

    /**
     * @Route("/erase", name="supprimer_articles", methods={"GET"})
     */
    public function eraseAction()
    {

        return $this->render('articles/erase.html.twig');
    }

    /**
     * @Route("/search", name="ma_recherche", methods={"GET"})
     */
    public function searchAction(Request $request)
    {
        $q = $request->query->get('q'); // use "term" instead of "q" for jquery-ui
        $results = $this->getDoctrine()->getRepository('App:Articles')->findLikeName($q);

        return $this->render('search.json.twig', ['results' => $results]);
    }

    public function getArticles($id = null)
    {
        $article = $this->getDoctrine()->getRepository('App:Articles')->find($id);

        return $this->json($article->getName());

    }
}
