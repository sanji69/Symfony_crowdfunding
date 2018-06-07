<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
$token = bin2hex(random_bytes(100));
$user->setToken($token);
$user->setRoles($roles);

$manager->persist($user);
$this->addReference($username, $user);
}

$manager->flush();
}

private function getUserData(): array
{
return [
// $userData = [$$username, $lastname, $firstname, $password, $email, $roles];
['jane_admin', 'Doe', 'Jane', 'kitten', 'jane_admin@symfony.com', ['ROLE_ADMIN']],
['tom_admin', 'Doe', 'Tom', 'kitten', 'tom_admin@symfony.com', ['ROLE_ADMIN']],
['john_user', 'Doe', 'John', 'kitten', 'john_user@symfony.com', ['ROLE_USER']],
];
}


}