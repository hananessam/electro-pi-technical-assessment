<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService) {}

    /**
     * Return an aggregate summary of the authenticated user's projects and tasks.
     */
    public function index(Request $request)
    {
        return response()->json($this->dashboardService->summaryForUser($request->user()->id));
    }
}
