<?php

namespace App\DataFixtures;

use App\Entity\Contributor;
use App\Entity\Users;
USE App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
//use Symfony\Component\Validator\Constraints\DateTime;

use \DateTime;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$username, $lastname, $firstname, $password, $email, $roles]) {
            $user = new Users();
            $user->setUsername($username);
            $user->setLastname($lastname);
            $user->setFirstname($firstname);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setEmail($email);
            $user->setToken(rand(250,1000));
            $user->setRoles($roles);

            $manager->persist($user);
            $this->addReference($username, $user);
        }

        $manager->flush();

        foreach ($this->getArtData() as [$title, $content, $goal, $status, $actived, $user) {
            $article = new Articles();
            $article->setTitle($title);
            $article->setContent($content);
            $article->setGoal($goal);
            $article->setStatus($status);
            $article->setActived($actived);
            $article->setUser($user);

            $manager->persist($article);
            $this->addReference($title, $article);
        }

        $manager->flush();

        foreach ($this->getContData() as [$users, $articles, $value]) {
            $contrib = new Contributor();
            $contrib->setUsers($users);
            $contrib->setArticles($articles);
            $contrib->setValue($value);
            $submit = new DateTime();
            $contrib->setSubmitAt($submit);

            $manager->persist($contrib);
        }

        $manager->flush();
    }

    private function getUserData(): array
        {
        return [
            // $userData = [$username, $lastname, $firstname, $password, $email, $roles];
            ['jane_admin', 'Doe', 'Jane', 'kitten', 'jane_admin@symfony.com', 'a:1:{i:0;s:10:"ROLE_ADMIN";}'],
            ['tom_admin', 'Doe', 'Tom', 'kitten', 'tom_admin@symfony.com', 'a:1:{i:0;s:10:"ROLE_ADMIN";}'],
            ['john_user', 'Doe', 'John', 'kitten', 'john_user@symfony.com', 'a:1:{i:0;s:9:"ROLE_USER";}'],
        ];
    }

    private function getArtData(): array
    {
        return [
            // $userData = [$title, $content, $goal, $status, $actived, $user_id];
            ['titre1', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 1000, 1000, 1, 1],
            ['titre2', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 2500, 800, 0, 2],
            ['titre3', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 3000, 1200, 1,3],
            ['titre4', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 5000, 1000, 0, 1],
            ['titre5', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 1000, 800, 1, 1],
            ['titre6', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 1200, 1200, 0, 2],
            ['titre7', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 3000, 1000, 1, 1],
            ['titre8', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 15000, 800, 1, 3],

        ];
    }

    private function getContData(): array
    {
        return [
            // $userData = [$users_id, $articles_id, $value];
            [1, 1, 500],
            [2, 2, 400],
            [3, 3, 600],
            [1, 4, 500],
            [2, 5, 400],
            [3, 6, 600],
            [1, 7, 500],
            [2, 8, 400],

            [3, 1, 500],
            [1, 2, 400],
            [2, 3, 600],
            [3, 4, 500],
            [1, 5, 400],
            [2, 6, 600],
            [3, 7, 500],
            [1, 8, 400],
        ];
    }
}