<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
    /**
     * @var integer $id
     * @Route("/teams/{id}", name="getTeam", methods={"GET"})
     * @return JsonResponse
     */
    public function getTeamListAction($id)
    {
        $teamService = $this->get('app.team');
        $teams = $teamService->getList($id);

        return new JsonResponse([
            'status' => true,
            'data' => $teams
        ], 200);
    }

    /**
     * @var Request $request
     * @Route("/team", name="createTeam", methods={"POST"})
     * @return JsonResponse
     */
    public function createTeamAction(Request $request)
    {
        $name = $request->request->get('name');
        $strip = $request->request->get('strip');
        $league = $request->request->get('league');

        $teamService = $this->get('app.team');
        $team = $teamService->create($name, $strip, $league);


        return new JsonResponse([
            'status' => true,
            'message' => $team
        ], 200);
    }

    /**
     * @var Request $request
     * @Route("/team", name="editTeam", methods={"PUT"})
     * @return JsonResponse
     */
    public function editTeamAction(Request $request)
    {
        $teamService = $this->get('app.team');

        $name = $request->query->get('name');
        $strip = $request->query->get('strip');
        $id = $request->query->get('id');

        $team = $teamService->edit($name, $strip, $id);

        return new JsonResponse([
            'status' => true,
            'message' => $team
        ], 200);
    }
}
