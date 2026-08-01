<?php

namespace Modules\Task\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
