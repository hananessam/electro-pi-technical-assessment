<?php

namespace Modules\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Project\Http\Requests\StoreProjectRequest;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = $this->projectService->create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return (new ProjectResource($project))->response()->setStatusCode(201);
    }
}
