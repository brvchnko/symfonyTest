<?php

namespace App\Repository;


use Doctrine\ORM\EntityManager;

class UserRepository
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findOneByCredentials($username, $password)
    {
        $user = $this->em->getRepository('App:Users')->findBy(['login' => $username, 'password' => $password]);

        return $user;
    }
}
