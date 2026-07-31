<?php

namespace Modules\Project\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Project\Models\Project;
use Modules\Project\Repositories\Contracts\ProjectInterface;

class ProjectRepository implements ProjectInterface
{
    public function allForUser(int $userId): Collection
    {
        return Project::where('user_id', $userId)->get();
    }

    public function create(array $data): Project
    {
        return Project::create($data);
    }

    public function update(Project $project, array $data): Project
    {
        $project->update($data);

        return $project;
    }
}
