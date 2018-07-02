<?php

namespace App\Controller;


use App\Entity\Users;
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
        if ($request->request->has('username') && $request->request->has('password')) {
            $userService = $this->get('app.user');
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            $userService->create($username, $password);

            return new JsonResponse([
                'status' => true,
                'message' => sprintf(Users::SUCCESSFULLY_CREATED, $username)
            ], 200);
        }
        return new JsonResponse([
            'status' => true,
            'message' => Users::ERROR_REGISTR
        ], 403);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/api/login", name="login", methods={"POST"})
     */
    public function loginAction(Request $request)
    {
        if ($request->request->has('username') && $request->request->has('password')) {
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

        }
        return new JsonResponse([
            'status' => true,
            'message' => Users::ERROR_LOGIN
        ], 403);
    }
}
