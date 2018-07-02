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
     * @Route("/league", name="newLeague", methods={"POST"})
     * @return JsonResponse
     */
    public function createLeagueAction(Request $request)
    {
        $leagueService = $this->get('app.league');
        $league = $leagueService->create($request->request->get('name'));

        return new JsonResponse([
            'status' => 'true',
            'message' => $league
        ], 200);
    }

    /**
     * @var integer $id
     * @Route("/league/{id}", name="removeLeague", methods={"DELETE"})
     * @return JsonResponse
     */
    public function deleteLeagueAction($id)
    {
        $leagueService = $this->get('app.league');
        $league = $leagueService->remove($id);

        return new JsonResponse([
            'status' => 'true',
            'message' => $league
        ], 200);
    }
}
