<?php

namespace App\Domain\Categories\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Domain\Categories\Services\CategoriesService;
use Illuminate\Http\JsonResponse;

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
}