<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LeagueController extends Controller
{
    /**
     * @param Request $request
     * @Route("/new_league", name="newLeague", methods={"POST"})
     * @return JsonResponse
     */
    public function createLeagueAction(Request $request)
    {
        if ($request->request->has('name')) {
            $leagueService = $this->get('app.league');
            $league = $leagueService->create($request->request->get('name'));

            return new JsonResponse([
                'status' => 'true',
                'message' => "New League $league was created!"
            ], 200);
        }

        return new JsonResponse([
            'status' => 'false',
            'message' => 'Name cannot be null'
        ], 403);
    }

    /**
     * @var integer $id
     * @Route("/del_league/{id}", name="removeLeague", methods={"DELETE"})
     * @return JsonResponse
     */
    public function deleteLeagueAction($id)
    {
        if ($id) {
            $leagueService = $this->get('app.league');
            $league = $leagueService->remove($id);

            return new JsonResponse([
                'status' => 'true',
                'message' => ($league == true) ? "League $league was removed!" : "League with ID $id was not found"
            ], 200);
        }

        return new JsonResponse([
            'status' => 'false',
            'message' => 'ID cannot be null'
        ], 403);
    }
}
