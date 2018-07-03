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
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('t')
            ->from('App:Team', 't')
            ->where('t.league = :id')
            ->setParameter('id', $leagueId)
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        return $result;
    }
    public function findOneById($leagueId)
    {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select('l')
            ->from('App:League', 'l')
            ->where('l.id = :id')
            ->setParameter('id', $leagueId)
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        return $result;
    }
}
