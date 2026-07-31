<?php

namespace Modules\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Project\Http\Requests\StoreProjectRequest;
use Modules\Project\Http\Requests\UpdateProjectRequest;
use Modules\Project\Models\Project;
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

    /**
     * Show the specified resource.
     */
    public function show(Request $request, int $id)
    {
        $project = $this->findOwnedOrFail($request, $id);

        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, int $id)
    {
        $project = $this->findOwnedOrFail($request, $id);

        $project = $this->projectService->update($project, $request->validated());

        return new ProjectResource($project);
    }

    /**
     * Find a project by id, aborting with 404 if missing or 403 if not owned by the authenticated user.
     */
    private function findOwnedOrFail(Request $request, int $id): Project
    {
        $project = $this->projectService->find($id);

        abort_if(! $project, 404);

        abort_if($project->user_id !== $request->user()->id, 403);

        return $project;
    }
}
