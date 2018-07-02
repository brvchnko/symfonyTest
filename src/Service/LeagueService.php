<?php

namespace App\Service;

use App\Entity\League;
use Doctrine\ORM\EntityManager;

class LeagueService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function remove($id)
    {
        $teams = $this->em->getRepository('App:League')->findByLeague($id);

        if ($teams != null) {
            foreach ($teams as $team) {
                $this->em->remove($team);
            }

            $this->em->flush();
        }

        $league = $this->em->getRepository('App:League')->findOneById($id);

        if ($league != null) {
            $leagueName = $league->getName();

            $this->em->remove($league);
            $this->em->flush();

            return $leagueName;
        }
        return false;
    }

    public function create($name)
    {
        $newLeague = new League();

        $newLeague->setName($name);

        $this->em->persist($newLeague);
        $this->em->flush();

        return $newLeague->getName();
    }
}