<?php

namespace App\Domain\Login\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domain\Users\Services\UsersService;
use Illuminate\Http\JsonResponse;
use App\Domain\Users\Entities\Users;


class LoginController extends Controller
{
    public function __construct(
        private UsersService $service
    )
    {}

    public function login(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = $this->service->getByEmail($request->input('email'));
            if (is_null($user)) {
                throw new \Exception("Usuário não encontrado");
            } else if ($user->status == 1) {
                throw new \Exception("Sua conta está temporariamente bloqueada. Para reativá-la.");
            }

            $token = auth()->attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);

            return $this->respondWithToken($token, $user);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    protected function respondWithToken(string $token, Users $user)
    {

        $data = [
            'userData' => [
                'id' => $user->id,
                'name' => $user->name,
                'lastname' => '',
                'email' => $user->email
            ],
            'accessToken' => $token,
            'refreshToken' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 2400
        ];
        
        return response()->json($data, Response::HTTP_OK);
    }
}