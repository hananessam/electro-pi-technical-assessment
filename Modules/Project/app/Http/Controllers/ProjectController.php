<?php

namespace Modules\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Project\Services\ProjectService;

class ProjectController extends Controller
{
    public function __construct(public ProjectService $projectService) {}
}
