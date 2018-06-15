<?php

namespace App\Controller;

use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Articles;


class ArticlesController extends Controller
{

    /**
    * @Route("/", name="index")
    */
    public function indexAction(request $request)
    {
       //Appel de l'entity Manager
        $articles = $this
            ->getDoctrine()
            ->getRepository(Articles::class)
            ->articlesNews()
        ;

        return $this->render("articles/index.html.twig", [
            "articles" => $articles
        ]);
    }

    /**
     * @Route("/add", name="creer_articles", methods={"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $articles = new Articles;

        $form = $this->createForm(ArticlesType::class, $articles);

        if($form->handleRequest($request)->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();

            $data = $form->getData();

            $user = $this->getUser();
            $articles->setUser($user);
            $articles->setActived(0);
            $articles->setStatus(0);
            $em->persist($articles);

            $em->flush();

                return $this->redirectToRoute("articles/retrieve.html.twig", [
                   "title"=>$articles->getTitle(),
                   "id"=>$articles->getId()
               ]);
        }
            $form = $form->createView();

        return $this->render("articles/add.html.twig", [
            "form"=>$form
            ]);


    }

    /**
     * @Route("/retrieve", name="retrieve", methods={"GET", "POST"})
     */
    public function retrieveAction($title, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em
            ->getRepository('Articles')
            ->find($id);


            return $this->render("articles/retrieve.html.twig",
            ["article" => $article]

             );
    }

    /**
     * @Route("/update", name="mon_articles", methods={"GET"})
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em
            ->getRepository(Articles::class)
            ->find($id);



        $form = $this->createForm(ArticlesType::class, $article);
        if($form->handleRequest($request)->isSubmitted())
        {
            $data =  $form->getData();

            $user = $this->getUser();
            $article->setUser($user);
            $article->setActived(0);
            $article->setStatus(0);

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('articles/retrieve.html.twig',
                [
                    "title"=>$article->getTile(),
                    "id"=>$article->getId()
                ]);
        }


        $form = $form->createView();
        return $this->render('articles/update.html.twig', [
            "form" => $form
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
