<?php

namespace App\Controller;

use App\Form\UsersType;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsersController extends Controller
{
    /**
     * La route pour se deconnecter. "intercepté par symfony"
     *
     * @Route("/logout", name="security_logout")
     */
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }

    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $helper): Response
    {
        return $this->render('users/login.html.twig', [
            // dernier username saisi (si il y en a un)
            'last_username' => $helper->getLastUsername(),
            // La derniere erreur de connexion (si il y en a une)
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }

    /**
    * @Route("/register", name="user_registration", methods={"GET", "POST"})
    */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // mise en place du formulaire
        $user = new Users();
//        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(UsersType::class, $user);

        // preparer la requete
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            // cryptage du password et ajout token
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $token = bin2hex(random_bytes(100));
            $user->SetToken($token);

            // enregistrement de l'utilisateur dans la BDD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('security_login"');
        }

        return $this->render(
        'users/register.html.twig',
        array('form' => $form->createView())
        );
    }

}
