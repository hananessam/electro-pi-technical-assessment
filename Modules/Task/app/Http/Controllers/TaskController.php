<?php

namespace Modules\Task\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Project\Models\Project;
use Modules\Task\DataTransferObjects\TaskDTO;
use Modules\Task\DataTransferObjects\UpdateTaskDTO;
use Modules\Task\Http\Requests\StoreTaskRequest;
use Modules\Task\Http\Requests\UpdateTaskRequest;
use Modules\Task\Models\Task;
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = $this->findOwnedOrFail($request, $id);

        $task = $this->taskService->update($task, UpdateTaskDTO::fromRequest($request));

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        $task = $this->findOwnedOrFail($request, $id);

        $this->taskService->delete($task);

        return response()->json(['message' => 'Task deleted successfully']);
    }

    /**
     * Find a task by id, aborting with 404 if missing or 403 if its project is not owned by the authenticated user.
     */
    private function findOwnedOrFail(Request $request, int $id): Task
    {
        $task = $this->taskService->find($id);

        abort_if(! $task, 404);

        abort_if($task->project->user_id !== $request->user()->id, 403);

        return $task;
    }
}
