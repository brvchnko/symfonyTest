<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeagueController extends Controller
{
    /**
     * @param Request $request
     * @Route("/league", name="newLeague", methods={"POST"})
     * @return Response
     */
    public function createLeagueAction(Request $request)
    {
        $leagueService = $this->get('app.league');
        $league = $leagueService->create($request->request->get('name'));
        return new Response($league);
    }
    /**
     * @var integer $id
     * @Route("/league/{id}", name="removeLeague", methods={"DELETE"})
     * @return Response
     */
    public function deleteLeagueAction($id)
    {
        $leagueService = $this->get('app.league');
        $league = $leagueService->remove($id);
        return new Response($league);
    }
}