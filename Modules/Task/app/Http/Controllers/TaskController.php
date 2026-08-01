<?php

namespace Modules\Task\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Project\Models\Project;
use Modules\Task\DataTransferObjects\TaskDTO;
use Modules\Task\Http\Requests\StoreTaskRequest;
use Modules\Task\Services\TaskService;
use Modules\Task\Transformers\TaskResource;

class TaskController extends Controller
{
    public function __construct(public TaskService $taskService)
    {
    }

    /**
     * Display a listing of the authenticated user's tasks.
     */
    public function index(Request $request)
    {
        $tasks = $this->taskService->listForUser($request->user()->id);

        return response()->json(TaskResource::collection($tasks));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $project = Project::findOrFail($request->validated('project_id'));

        abort_if($project->user_id !== $request->user()->id, 403);

        $task = $this->taskService->create(TaskDTO::fromRequest($request));

        return (new TaskResource($task))->response()->setStatusCode(201);
    }
}
