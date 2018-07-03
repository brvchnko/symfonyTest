<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    /**
     * @var integer $id
     * @Route("/teams/{id}", name="getTeam", methods={"GET"})
     * @return Response
     */
    public function getTeamListAction($id)
    {
        $teamService = $this->get('app.team');
        $teams = $teamService->getList($id);
        return new Response($teams);
    }
    /**
     * @var Request $request
     * @Route("/team", name="createTeam", methods={"POST"})
     * @return Response
     */
    public function createTeamAction(Request $request)
    {
        $name = $request->request->get('name');
        $strip = $request->request->get('strip');
        $league = $request->request->get('league');
        $teamService = $this->get('app.team');
        $team = $teamService->create($name, $strip, $league);

        return new Response($team);
    }
    /**
     * @var Request $request
     * @Route("/team", name="editTeam", methods={"PUT"})
     * @return Response
     */
    public function editTeamAction(Request $request)
    {
        $teamService = $this->get('app.team');
        $name = $request->query->get('name');
        $strip = $request->query->get('strip');
        $id = $request->query->get('id');
        $team = $teamService->edit($name, $strip, $id);

        return new Response($team);
    }
}