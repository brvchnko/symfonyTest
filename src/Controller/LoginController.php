<?php

namespace App\Controller;


use App\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;

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
    public function loginAction(Request $request, AuthenticationSuccessHandler $successHandler, JWTManager $jwt)
    {
        if ($request->request->has('username') && $request->request->has('password')) {
            $userService = $this->get('app.user');
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            $user = $userService->verify($username, $password);

            if ($user !== false) {

                return new JsonResponse([
                    'status' => true,
                    'token' => $successHandler->handleAuthenticationSuccess($user,null)
                ], 200);
            }

        }
        return new JsonResponse([
            'status' => true,
            'message' => Users::ERROR_LOGIN
        ], 403);
    }
}