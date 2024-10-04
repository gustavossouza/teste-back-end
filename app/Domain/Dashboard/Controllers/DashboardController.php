<?php

namespace App\Domain\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Domain\Dashboard\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        private DashboardService $service
    )
    {}

    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->service->dashboard()
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}