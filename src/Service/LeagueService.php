<?php

namespace App\Service;

use App\Entity\League;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LeagueService
{
    const ERROR_BLANK_ID = "ID cannot be null";
    const ERROR_REMOVE = "League with ID %d was not found";

    const SUCCESSFULLY_CREATE = "New League %s was created!";
    const SUCCESSFULLY_REMOVED = "League %s was removed!";

    private $em;
    private $validator;

    public function __construct(EntityManager $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function remove($id)
    {
        if ($id === null) {
            return self::ERROR_BLANK_ID;
        }

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

            return sprintf(self::SUCCESSFULLY_REMOVED, $leagueName);
        }
        return sprintf(self::ERROR_REMOVE, $id);
    }

    public function create($name)
    {
        $newLeague = new League();

        $newLeague->setName($name);

        $errors = $this->validator->validate($newLeague);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $errorsString;
        }

        $this->em->persist($newLeague);
        $this->em->flush();

        return sprintf(League::SUCCESSFULLY_CREATE, $newLeague->getName());
    }
}
