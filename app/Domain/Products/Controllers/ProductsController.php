<?php

namespace App\Domain\Products\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domain\Products\Services\ProductsService;
use Illuminate\Http\JsonResponse;
use App\Domain\Products\Formrequest\ProductsRequest;

class ProductsController extends Controller
{
    public function __construct(
        private ProductsService $service
    )
    {}

    public function index(Request $request): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->service->get($request->all())
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $productId): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->service->getById($productId)
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(ProductsRequest $request): JsonResponse
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

    public function update(ProductsRequest $request, int $productId): JsonResponse
    {
        try {
            $this->service->update($request->validated(), $productId);

            return response()->json([
                'data' => 'Updated'
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $productId): JsonResponse
    {
        try {
            $product = $this->service->delete($productId);

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
