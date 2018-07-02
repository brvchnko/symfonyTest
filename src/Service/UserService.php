<?php

namespace App\Service;


use App\Entity\Users;
use Doctrine\ORM\EntityManager;

class UserService
{
    const ERROR_REGISTR = "Invalid data for user registration!";
    const ERROR_LOGIN = "Incorrect username or password.";

    const SUCCESSFULLY_CREATED = "User %s was successfully created!";

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create($username, $password)
    {
        if ($username && $password) {
            $user = new Users();

            $user->setLogin($username);
            $user->setPassword($password);

            $this->em->persist($user);
            $this->em->flush();

            return sprintf(self::SUCCESSFULLY_CREATED, $username);
        }
        return self::ERROR_REGISTR;
    }

    public function verify($username, $password)
    {
        $user = $this->em->getRepository('App:Users')
            ->findOneByCredentials($username, $password);

        if ($user != null) {
            return $user;
        }
        return false;
    }
}
