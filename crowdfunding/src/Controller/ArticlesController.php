<?php

namespace App\Controller;

use App\Entity\Contributor;
use App\Form\ArticlesType;
use App\Form\ContributorType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\Articles;
use \DateTime;


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

                return $this->redirectToRoute("retrieve", [
                   "id"=>$articles->getId()
               ]);
        }
            $form = $form->createView();

        return $this->render("articles/add.html.twig", [
            "form"=>$form
            ]);


    }

    /**
     * @Route("/retrieve/{id}", name="retrieve", methods={"GET", "POST"})
     */
    public function retrieveAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em
            ->getRepository(Articles::class)
            ->find($id);

        if(!$article)
        {
            throw $this->createNotFoundException('Cette page n\'existe pas');
        }

        $contrib = new Contributor();
        $form = $this->createForm(ContributorType::class, $contrib);

        if($form->handleRequest($request)->isSubmitted())
        {
            //ajout de la transaction en base de donnée

            $em = $this->getDoctrine()->getManager();

            $data = $form->getData();
            $user = $this->getUser();
            $contrib->setUsers($user);
            $submit = new \DateTime();
            $contrib->setSubmitAt($submit);
            $contrib->setArticles($article);
            $em->persist($contrib);
            $em->flush();

            //mise a jour du status articles dans la BDD

            $status = $article->getStatus();
            $status += $data->getValue();
            $article->setStatus($status);
            $em->persist($article);
            $em->flush();
        }

        return $this->render("articles/retrieve.html.twig",
            [
                "article" => $article,
                'form' => $form->createView()
            ]);
    }

    // route activation

    /**
     * @Route("/enable/{id}", name="activer", methods={"GET", "POST"})
     */
    public function enableAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em
            ->getRepository(Articles::class)
            ->find($id);

        $article->setActived(1);
        $em->persist($article);
        $em->flush();

        return $this->redirectToRoute("retrieve", [
            "id"=>$id
        ]);

    }

    // route désactivation

    /**
     * @Route("/disable/{id}", name="desactiver", methods={"GET", "POST"})
     */
    public function disableAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em
            ->getRepository(Articles::class)
            ->find($id);
        $article->setActived(0);
        $em->persist($article);
        $em->flush();

        return $this->redirectToRoute("retrieve", array(
            "id"=> $id
        ));
    }

    /**
     * @Route("/update/{id}", name="update", methods={"GET", "POST"})
     */
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em
            ->getRepository(Articles::class)
            ->find($id)
        ;

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
            return $this->redirectToRoute('retrieve',
                [
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

//    /**
//     * @Route("/search", name="search", methods={"GET"})
//     */
//    public function searchAction(Request $request)
//    {
//        $q = $request->query->get('q'); // use "term" instead of "q" for jquery-ui
//        $results = $this->getDoctrine()->getRepository('App:Articles')->findLikeName($q);
//
//        return $this->render('search.json.twig', ['results' => $results]);
//    }

//    public function getArticles($id = null)
//    {
//        $article = $this->getDoctrine()->getRepository('App:Articles')->find($id);
//
//        return $this->json($article->getName());
//
//    }
}
