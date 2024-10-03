<?php

namespace App\Domain\Categories\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domain\Categories\Services\CategoriesService;
use Illuminate\Http\JsonResponse;
use App\Domain\Categories\FormRequest\CategoriesRequest;

class CategoriesController extends Controller
{
    public function __construct(
        private CategoriesService $service
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

    public function show(int $categoryId): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->service->getById($categoryId)
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CategoriesRequest $request): JsonResponse
    {
        try {
            $this->service->create($request->validated());

            return response()->json([
                'data' => 'Created'
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CategoriesRequest $request, int $categoryId): JsonResponse
    {
        try {
            $this->service->update($request->validated(), $categoryId);

            return response()->json([
                'data' => 'Updated'
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
            // verificar se tem produto relacionado e proibir
            
            $category = $this->service->delete($categoryId);

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