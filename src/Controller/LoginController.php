<?php

namespace App\Controller;


use App\Service\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(Request $request)
    {
        $userService = $this->get('app.user');
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $user = $userService->create($username, $password);

        return new Response($user);
    }

    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}
