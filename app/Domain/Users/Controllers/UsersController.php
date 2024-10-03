<?php

namespace App\Domain\Users\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domain\Users\Services\UsersService;
use Illuminate\Http\JsonResponse;

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

    public function create(Request $request): JsonResponse
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

    public function update(Request $request, int $categoryId): JsonResponse
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

    public function destroy(int $categoryId): JsonResponse
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
}