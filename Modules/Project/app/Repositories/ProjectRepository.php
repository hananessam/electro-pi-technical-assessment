<?php

namespace Modules\Project\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Project\DataTransferObjects\ProjectDTO;
use Modules\Project\DataTransferObjects\UpdateProjectDTO;
use Modules\Project\Models\Project;
use Modules\Project\Repositories\Contracts\ProjectInterface;

class ProjectRepository implements ProjectInterface
{
    public function allForUser(int $userId): Collection
    {
        return Project::where('user_id', $userId)->get();
    }

    public function find(int $id): ?Project
    {
        return Project::find($id);
    }

    public function create(ProjectDTO $data): Project
    {
        return Project::create($data->toArray());
    }

    public function update(Project $project, UpdateProjectDTO $data): Project
    {
        $project->update($data->toArray());

        return $project;
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
