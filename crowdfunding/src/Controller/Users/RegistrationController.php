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

class RegistrationController extends Controller
{

    /**
     * @Route("/register", name="user_registration", methods={"GET", "POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EventDispatcherInterface $eventDispatcher)
    {
        // mise en place du formulaire
        $user = new Users();
        $user->setRoles(['ROLE_USER']);
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

            //On déclenche l'event envoy du mail pour vérification validation compte
            $event = new GenericEvent($user);
            $eventDispatcher->dispatch(Events::USER_REGISTERED, $event);


            return $this->redirectToRoute('security_login');
        }

        return $this->render(
            'users/register.html.twig',
            array('form' => $form->createView())
        );
    }

}
