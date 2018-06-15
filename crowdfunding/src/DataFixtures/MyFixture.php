<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Entity\Articles;
use App\Entity\Contributor;
use \DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MyFixture extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        /*
         * Users Fixtures
         */
        // user 1
        $user1 = new Users();
        $user1->setUsername('jane_admin');
        $user1->setLastname('Doe');
        $user1->setFirstname('Jane');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'kitten'));
        $user1->setEmail('jane_admin@symfony.com');
        $user1->setToken(rand(250, 1000));
        $user1->setRoles('ROLE_ADMIN');
        $manager->persist($user1);
        $this->addReference('jane_admin', $user1);


        // user 2
        $user2 = new Users();
        $user2->setUsername('tom_admin');
        $user2->setLastname('Tom');
        $user2->setFirstname('Jane');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'kitten'));
        $user2->setEmail('tom_admin@symfony.com');
        $user2->setToken(rand(250, 1000));
        $user2->setRoles('ROLE_ADMIN');
        $manager->persist($user2);
        $this->addReference('tom_admin', $user2);


        // user 3
        $user3 = new Users();
        $user3->setUsername('john_user');
        $user3->setLastname('Doe');
        $user3->setFirstname('John');
        $user3->setPassword($this->passwordEncoder->encodePassword($user3, 'kitten'));
        $user3->setEmail('john_user@symfony.com');
        $user3->setToken(rand(250, 1000));
        $user3->setRoles('ROLE_USER');
        $manager->persist($user3);
        $this->addReference('john_user', $user3);


        /*
         * Fin Users Fixtures
         */

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /*
         * Articles Fixtures
         */
        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article1 = new Articles();
        $article1->setTitle('titre1');
        $article1->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
        $article1->setGoal($i*$v);
        $article1->setStatus(1000);
        $article1->setUser($user1);
        $article1->setActived(0);
        $manager->persist($article1);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article2 = new Articles();
        $article2->setTitle('titre2');
        $article2->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
        $article2->setGoal($i*$v);
        $article2->setStatus(1000);
        $article2->setUser($user2);
        $article2->setActived(1);
        $manager->persist($article2);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article3 = new Articles();
        $article3->setTitle('titre3');
        $article3->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
        $article3->setGoal($i*$v);
        $article3->setStatus(1000);
        $article3->setUser($user3);
        $article3->setActived(1);
        $manager->persist($article3);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article4 = new Articles();
        $article4->setTitle('titre4');
        $article4->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
        $article4->setGoal($i*$v);
        $article4->setStatus(1000);
        $article4->setUser($user1);
        $article4->setActived(0);
        $manager->persist($article4);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article5 = new Articles();
        $article5->setTitle('titre5');
        $article5->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
        $article5->setGoal($i*$v);
        $article5->setStatus(1000);
        $article5->setUser($user2);
        $article5->setActived(1);
        $manager->persist($article5);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article6 = new Articles();
        $article6->setTitle('titre6');
        $article6->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
        $article6->setGoal($i*$v);
        $article6->setStatus(1000);
        $article6->setUser($user3);
        $article6->setActived(1);
        $manager->persist($article6);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article7 = new Articles();
        $article7->setTitle('titre7');
        $article7->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
        $article7->setGoal($i*$v);
        $article7->setStatus(1000);
        $article7->setUser($user1);
        $article7->setActived(0);
        $manager->persist($article7);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article8 = new Articles();
        $article8->setTitle('titre8');
        $article8->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
        $article8->setGoal($i*$v);
        $article8->setStatus(1000);
        $article8->setUser($user2);
        $article8->setActived(1);
        $manager->persist($article8);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article9 = new Articles();
        $article9->setTitle('titre9');
        $article9->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum');
        $article9->setGoal($i*$v);
        $article9->setStatus(1000);
        $article9->setUser($user3);
        $article9->setActived(1);
        $manager->persist($article9);

        /*
         * Fin Articles Fixtures
         */

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /*
         * Contribution Fixtures
         */
        $contrib1 = new Contributor();
        $contrib1->setUsers($user1);
        $contrib1->setArticles($article1);
        $contrib1->setValue(500);
        $submit = new DateTime();
        $contrib1->setSubmitAt($submit);
        $manager->persist($contrib1);


        $contrib2 = new Contributor();
        $contrib2->setUsers($user2);
        $contrib2->setArticles($article1);
        $contrib2->setValue(500);
        $contrib2->setSubmitAt($submit);
        $manager->persist($contrib2);


        $contrib3 = new Contributor();
        $contrib3->setUsers($user3);
        $contrib3->setArticles($article2);
        $contrib3->setValue(500);
        $contrib3->setSubmitAt($submit);
        $manager->persist($contrib3);


        $contrib4 = new Contributor();
        $contrib4->setUsers($user1);
        $contrib4->setArticles($article2);
        $contrib4->setValue(500);
        $contrib4->setSubmitAt($submit);
        $manager->persist($contrib4);


        $contrib5 = new Contributor();
        $contrib5->setUsers($user2);
        $contrib5->setArticles($article3);
        $contrib5->setValue(500);
        $contrib5->setSubmitAt($submit);
        $manager->persist($contrib5);


        $contrib6 = new Contributor();
        $contrib6->setUsers($user3);
        $contrib6->setArticles($article3);
        $contrib6->setValue(500);
        $contrib6->setSubmitAt($submit);
        $manager->persist($contrib6);


        $contrib7 = new Contributor();
        $contrib7->setUsers($user1);
        $contrib7->setArticles($article4);
        $contrib7->setValue(500);
        $contrib7->setSubmitAt($submit);
        $manager->persist($contrib7);


        $contrib8 = new Contributor();
        $contrib8->setUsers($user2);
        $contrib8->setArticles($article4);
        $contrib8->setValue(500);
        $contrib8->setSubmitAt($submit);
        $manager->persist($contrib8);

        $contrib9 = new Contributor();
        $contrib9->setUsers($user3);
        $contrib9->setArticles($article5);
        $contrib9->setValue(500);
        $contrib9->setSubmitAt($submit);
        $manager->persist($contrib9);


        $contrib10 = new Contributor();
        $contrib10->setUsers($user1);
        $contrib10->setArticles($article5);
        $contrib10->setValue(500);
        $contrib10->setSubmitAt($submit);
        $manager->persist($contrib10);


        $contrib11 = new Contributor();
        $contrib11->setUsers($user2);
        $contrib11->setArticles($article6);
        $contrib11->setValue(500);
        $contrib11->setSubmitAt($submit);
        $manager->persist($contrib11);

        $contrib12 = new Contributor();
        $contrib12->setUsers($user3);
        $contrib12->setArticles($article6);
        $contrib12->setValue(500);
        $contrib12->setSubmitAt($submit);
        $manager->persist($contrib12);


        $contrib13 = new Contributor();
        $contrib13->setUsers($user1);
        $contrib13->setArticles($article7);
        $contrib13->setValue(500);
        $contrib13->setSubmitAt($submit);
        $manager->persist($contrib13);


        $contrib14 = new Contributor();
        $contrib14->setUsers($user2);
        $contrib14->setArticles($article7);
        $contrib14->setValue(500);
        $contrib14->setSubmitAt($submit);
        $manager->persist($contrib14);


        $contrib15 = new Contributor();
        $contrib15->setUsers($user3);
        $contrib15->setArticles($article8);
        $contrib15->setValue(500);
        $contrib15->setSubmitAt($submit);
        $manager->persist($contrib15);


        $contrib16 = new Contributor();
        $contrib16->setUsers($user1);
        $contrib16->setArticles($article8);
        $contrib16->setValue(500);
        $contrib16->setSubmitAt($submit);
        $manager->persist($contrib16);


        $contrib17 = new Contributor();
        $contrib17->setUsers($user2);
        $contrib17->setArticles($article9);
        $contrib17->setValue(500);
        $contrib17->setSubmitAt($submit);
        $manager->persist($contrib17);


        $contrib18 = new Contributor();
        $contrib18->setUsers($user3);
        $contrib18->setArticles($article9);
        $contrib18->setValue(500);
        $contrib18->setSubmitAt($submit);
        $manager->persist($contrib18);


        $manager->flush();

    }
}
