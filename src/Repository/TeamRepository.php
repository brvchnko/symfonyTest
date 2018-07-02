<?php

namespace App\Repository;


use Doctrine\ORM\EntityManager;

class TeamRepository
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

    public function findOneById($teamId)
    {
        $league = $this->em->getRepository('App:Team')->findOneBy(['id' => $teamId]);

        return $league;
    }
}