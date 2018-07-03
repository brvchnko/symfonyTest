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
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('t')
            ->from('App:Team', 't')
            ->where('t.league = :id')
            ->setParameter('id', $leagueId)
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        return $result;
    }
    public function findOneById($teamId)
    {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('t')
            ->from('App:Team', 't')
            ->where('t.id = :id')
            ->setParameter('id', $teamId)
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        return $result;
    }
}
