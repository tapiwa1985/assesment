<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @var UserRepositoryInterface $userRepository
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->getUserByEmail($request);
        if ($user) {
            if (Hash::check($request->get('password'), $user->password)) {
                $token = $user->createToken('accessToken')->accessToken;

                return response()->json([
                    'token' => $token,
                    'user' => $user
                ]);
            } else {
                return response()->json(['message' => 'Unauthorised'], Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return response()->json(['message' => 'Unauthorised'], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @param Request $request
     * @return User|null
     */
    private function getUserByEmail(Request $request): ?User
    {
        return $this->userRepository->findByEmail($request->get('email'));
    }
}
