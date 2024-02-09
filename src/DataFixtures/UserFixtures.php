<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
;

class UserFixtures extends Fixture
{
private $hasher;

public function __construct(UserPasswordHasherInterface $hasher){
$this->hasher = $hasher;
}
    public function load(ObjectManager $manager): void
    {
        $user = new User(); 
        $user->setEmail('user@user.fr');
        $user->setFirstname('Florian');
        $user->setLastname('Delaunay');       
        $user->setPassword($this->hasher->hashPassword($user, "user"));
        // $product = new Product();
        // $manager->persist($product);

        $manager->persist($user);

        $manager->flush();
    }
}