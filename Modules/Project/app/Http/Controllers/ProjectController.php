<?php

namespace Modules\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Project\Services\ProjectService;
use Modules\Project\Transformers\ProjectResource;

class ProjectController extends Controller
{
    public function __construct(public ProjectService $projectService) {}

    /**
     * Display a listing of the authenticated user's projects.
     */
    public function index(Request $request)
    {
        return ProjectResource::collection($this->projectService->listForUser($request->user()->id));
    }
}
