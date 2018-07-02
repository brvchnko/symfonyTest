<?php

namespace App\Controller;

use App\Entity\League;
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
                'message' => sprintf(League::SUCCESSFULLY_CREATE, $league)
            ], 200);
        }

        return new JsonResponse([
            'status' => 'false',
            'message' => League::ERROR_BLANK_NAME
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
                'message' => ($league == true)
                    ? sprintf(League::SUCCESSFULLY_REMOVED, $league)
                    : sprintf(League::ERROR_REMOVE, $id)
            ], 200);
        }

        return new JsonResponse([
            'status' => 'false',
            'message' => League::ERROR_BLANK_ID
        ], 403);
    }
}
