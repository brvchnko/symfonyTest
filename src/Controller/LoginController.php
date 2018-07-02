<?php

namespace App\Controller;


use App\Service\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/register", name="register", methods={"POST"})
     */
    public function registerAction(Request $request)
    {
        $userService = $this->get('app.user');
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $user = $userService->create($username, $password);

        return new JsonResponse([
            'status' => true,
            'message' => $user
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/login", name="login", methods={"POST"})
     */
    public function loginAction(Request $request)
    {
        $userService = $this->get('app.user');
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $user = $userService->verify($username, $password);

        if ($user !== false) {
            //TODO TOKEN
            return new JsonResponse([
                'status' => true,
                'token' => 'token'
            ], 200);
        }

        return new JsonResponse([
            'status' => true,
            'message' => UserService::ERROR_LOGIN
        ], 403);
    }
}
