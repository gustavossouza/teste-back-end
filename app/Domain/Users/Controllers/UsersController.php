<?php

namespace App\Domain\Users\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domain\Users\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Hash;

class UsersController extends Controller
{
    public function __construct(
        private UsersService $service
    )
    {}

    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->service->get()
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $userId): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->service->getById($userId)
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'cellphone' => 'required',
                'password' => 'required',
            ]);

            $duplicate = $this->service->isDuplicate([
                'email' => $request->email
            ]);
            if ($duplicate) {
                throw new \Exception('Este email já está em uso. Por favor, escolha um nome diferente.');
            }

            $request->merge([
                'password' => Hash::make($request->password)
            ]);

            $this->service->create($request->only([
                'name',
                'email',
                'cellphone',
                'password',
            ]));

            return response()->json([
                'data' => 'Created'
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, int $userId): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'cellphone' => 'required',
                'password' => 'required',
            ]);

            $duplicate = $this->service->isDuplicate([
                'email' => $request->email
            ], $userId);
            
            if ($duplicate) {
                throw new \Exception('Este email já está em uso. Por favor, escolha um nome diferente.');
            }

            $request->merge([
                'password' => Hash::make($request->password)
            ]);

            $this->service->update($request->only([
                'name',
                'email',
                'cellphone',
                'password',
            ]), $userId);

            return response()->json([
                'data' => 'Updated'
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $userId): JsonResponse
    {
        try {
            $user = $this->service->delete($userId);

            return response()->json([
                'data' => 'Deleted'
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}