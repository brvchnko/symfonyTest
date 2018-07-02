<?php

namespace App\Controller;


use App\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
    /**
     * @var integer $id
     * @Route("/get_teams/{id}", name="getTeam", methods={"GET"})
     * @return JsonResponse
     */
    public function getTeamListAction($id)
    {
        if ($id) {
            $teamService = $this->get('app.team');
            $teams = $teamService->getList($id);

            return new JsonResponse([
                'status' => true,
                'data' => $teams
            ], 200);
        }
    }

    /**
     * @var Request $request
     * @Route("/new_team", name="createTeam", methods={"POST"})
     * @return JsonResponse
     */
    public function createTeamAction(Request $request)
    {
        if ($request->request->has('name')
            && $request->request->has('strip')
            && $request->request->has('league')) {

            $name = $request->request->get('name');
            $strip = $request->request->get('strip');
            $league = $request->request->get('league');

            $teamService = $this->get('app.team');
            $team = $teamService->create($name, $strip, $league);


            return new JsonResponse([
                'status' => true,
                'message' => ($team != false)
                    ? sprintf(Team::SUCCESSFULLY_CREATED, $team)
                    : Team::ERROR_LEAGUE_ID
            ], 200);
        }

        return new JsonResponse([
            'status' => false,
            'message' => Team::ERROR_DATA_CREATE
        ], 200);
    }
    /**
     * @var Request $request
     * @Route("/edit_team", name="editTeam", methods={"PUT"})
     * @return JsonResponse
     */
    public function editTeamAction(Request $request)
    {
        if ($request->query->has('strip') && $request->query->has('name') && $request->query->has('id')) {
            $teamService = $this->get('app.team');

            $name = $request->query->get('name');
            $strip = $request->query->get('strip');
            $id = $request->query->get('id');

            $team = $teamService->edit($name, $strip, $id);

            return new JsonResponse([
                'status' => true,
                'message' => ($team != false)
                    ? sprintf(Team::SUCCESSFULLY_EDITED, $team)
                    : sprintf(Team::ERROR_NOT_MATCHES, $id)
            ], 200);
        }

        return new JsonResponse([
            'status' => false,
            'message' => Team::ERROR_DATA_EDIT
        ], 403);
    }
}
