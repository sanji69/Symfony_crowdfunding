<?php

namespace App\Controller\Users;

use App\Form\UsersType;
use App\Events;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends Controller
{

    /**
     * @Route("/register", name="user_registration", methods={"GET", "POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EventDispatcherInterface $eventDispatcher)
    {
        // mise en place du formulaire
        $user = new Users();
        $user->setRoles('ROLE_USER');
        $user->setToken(rand(250,1000));
        $form = $this->createForm(UsersType::class, $user);

        // preparer la requete
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            // cryptage du password et ajout token
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // enregistrement de l'utilisateur dans la BDD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            //On déclenche l'event envoy du mail pour vérification validation compte
            $event = new GenericEvent($user);
            $eventDispatcher->dispatch(Events::USER_REGISTERED, $event);


            return $this->redirectToRoute('security_connexion');
        }

        return $this->render(
            'users/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * Connexion d'un utilisateur
     * @Route("/login", name="security_connexion")
     */
    public function connexion(Request $request, AuthenticationUtils $authenticationUtils)
    {
        # Récupération du message d'erreur s'il y en a un.
        $error = $authenticationUtils->getLastAuthenticationError();

        # Dernier email saisie par l'utilisateur.
        $lastEmail = $authenticationUtils->getLastUsername();

        # Affichage du Formulaire
        return $this->render('users/login.html.twig', array(
            'last_email' => $lastEmail,
            'error' => $error,
        ));
    }

    /**
    * La route pour se deconnecter. "intercepté par symfony"
    *
    * @Route("/logout", name="security_logout")
    */
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }

}
