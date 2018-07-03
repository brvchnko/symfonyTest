<?php

namespace App\Service;


use App\Entity\Users;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    const ERROR_REGISTR = "Invalid data for user registration!";
    const ERROR_LOGIN = "Incorrect username or password.";

    const SUCCESSFULLY_CREATED = "User %s was successfully created!";

    private $em;
    private $encoder;

    public function __construct(EntityManager $em, UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;

    }

    public function create($username, $password)
    {
        if ($username && $password) {
            $user = new Users();

            $user->setUsername($username);
            $user->setPassword($this->encoder->encodePassword($username, $password));

            $this->em->persist($user);
            $this->em->flush();

            return sprintf(self::SUCCESSFULLY_CREATED, $username);
        }
        return self::ERROR_REGISTR;
    }
}
