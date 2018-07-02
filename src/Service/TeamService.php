<?php

namespace App\Service;


use App\Entity\Team;
use Doctrine\ORM\EntityManager;

class TeamService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create($name, $stripe, $league)
    {
        $league = $this->em->getRepository('App:League')->findOneBy(['id' => $league]);

        if ($league != null) {
            $team = new Team();

            $team->setName($name);
            $team->setStrip($stripe);
            $team->setLeague($league);;

            $this->em->persist($team);
            $this->em->flush();

            return $team->getName();
        }
        return false;
    }

    public function edit($name, $strip, $id)
    {
        $team = $this->em->getRepository('App:Team')->findOneBy(['id' => $id]);

        if ($team != null) {
            $teamName = $team->getName();

            $team->setName($name);
            $team->setStrip($strip);

            $this->em->flush();

            return $teamName;
        }

        return false;
    }

    public function getList($id)
    {
        $listOfTeams = $this->em->getRepository('App:Team')->findBy(['league' => $id]);

        $list = [];

        foreach ($listOfTeams as $key => $team) {
            $list[$key]['name'] = $team->getName();
            $list[$key]['league'] = $team->getLeague()->getName();
            $list[$key]['strip'] = $team->getStrip();
        }

        return $list;
    }
}
