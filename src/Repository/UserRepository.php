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
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('u')
            ->from('App:Users', 'u')
            ->where('u.login = :login')
            ->andWhere('u.password = :password')
            ->setParameter('login', $username)
            ->setParameter('password', $password)
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $result;
    }
}
