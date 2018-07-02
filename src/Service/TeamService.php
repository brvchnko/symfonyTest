<?php

namespace App\Service;


use App\Entity\Team;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TeamService
{
    const ERROR_LEAGUE_ID = "Invalid league ID";
    const ERROR_TEAM_ID = "Invalid team ID";
    const ERROR_DATA_CREATE = "Invalid data for team creating, %s";
    const ERROR_DATA_EDIT = "Invalid data for team editing, %s";
    const ERROR_NOT_MATCHES = "ID %d does not match to anyone leagues";

    const SUCCESSFULLY_CREATED = "Team %s was created!";
    const SUCCESSFULLY_EDITED = "Team %s was edited!";


    private $em;
    private $validator;

    public function __construct(EntityManager $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function create($name, $stripe, $leagueID)
    {
        $league = $this->em->getRepository('App:League')->findOneById($leagueID);

        if ($league != null) {
            $team = new Team();

            $team->setName($name);
            $team->setStrip($stripe);
            $team->setLeague($league);;

            $errors = $this->validator->validate($team);

            if (count($errors) > 0) {

                $errorsString = (string) $errors;

                return spritf(self::ERROR_DATA_CREATE, $errorsString);
            }

            $this->em->persist($team);
            $this->em->flush();

            return sprintf(self::SUCCESSFULLY_CREATED, $team->getName());
        }
        return self::ERROR_LEAGUE_ID;
    }

    public function edit($name, $strip, $id)
    {
        $team = $this->em->getRepository('App:Team')->findOneById($id);

        if ($team != null) {
            $teamName = $team->getName();

            $team->setName($name);
            $team->setStrip($strip);

            $errors = $this->validator->validate($team);

            if (count($errors) > 0) {

                $errorsString = (string) $errors;

                return sprintf(self::ERROR_DATA_EDIT, $errorsString);
            }

            $this->em->flush();

            return sprintf(self::SUCCESSFULLY_EDITED, $teamName);
        }
        return sprintf(TeamService::ERROR_NOT_MATCHES, $id);
    }

    public function getList($id)
    {
        if ($id === null) {
            return self::ERROR_TEAM_ID;
        }

        $listOfTeams = $this->em->getRepository('App:Team')->findByLeague($id);

        $list = [];

        foreach ($listOfTeams as $key => $team) {
            $list[$key]['name'] = $team->getName();
            $list[$key]['league'] = $team->getLeague()->getName();
            $list[$key]['strip'] = $team->getStrip();
        }

        return $list;
    }
}
