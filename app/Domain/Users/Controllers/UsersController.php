<?php

namespace App\Domain\Users\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domain\Users\Services\UsersService;
use Illuminate\Http\JsonResponse;
use App\Domain\Users\FormRequest\UsersRequest;

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

    public function store(UsersRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $this->service->create($data);
            return response()->json([
                'data' => 'Created'
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UsersRequest $request, int $userId): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->service->update($data, $userId);

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