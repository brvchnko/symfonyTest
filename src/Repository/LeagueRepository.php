<?php

namespace App\Repository;


use Doctrine\ORM\EntityManager;

class LeagueRepository
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findByLeague($leagueId)
    {
        $teams = $this->em->getRepository('App:Team')->findBy(['league' => $leagueId]);

        return $teams;
    }

    public function findOneById($leagueId)
    {
        $league = $this->em->getRepository('App:League')->findOneBy(['id' => $leagueId]);

        return $league;
    }
}
