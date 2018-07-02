<?php

namespace App\Service;


use App\Entity\Users;
use Doctrine\ORM\EntityManager;

class UserService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create($username, $password)
    {
        $user = new Users();

        $user->setLogin($username);
        $user->setPassword($password);

        $this->em->persist($user);
        $this->em->flush();

        return true;
    }

    public function verify($username, $password)
    {
        $user = $this->em->getRepository('App:Users')
            ->findOneBy(['login' => $username, 'password' => $password]);

        if ($user != null) {
            return $user;
        }
        return false;
    }
}