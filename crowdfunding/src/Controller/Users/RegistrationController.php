<?php

namespace App\Controller\Users;

use App\Form\UsersType;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{

    /**
     * @Route("/register", name="user_registration", methods={"GET", "POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
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

            return $this->redirectToRoute('security_login');
        }

        return $this->render(
            'users/register.html.twig',
            array('form' => $form->createView())
        );
    }

}
