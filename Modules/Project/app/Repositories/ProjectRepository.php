<?php

namespace Modules\Project\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Project\DataTransferObjects\ProjectDTO;
use Modules\Project\DataTransferObjects\ProjectFilters;
use Modules\Project\DataTransferObjects\UpdateProjectDTO;
use Modules\Project\Enums\ProjectStatus;
use Modules\Project\Models\Project;
use Modules\Project\Repositories\Contracts\ProjectInterface;

class ProjectRepository implements ProjectInterface
{
    public function allForUser(int $userId): Collection
    {
        return Project::where('user_id', $userId)->get();
    }

    public function countForUser(int $userId, ProjectFilters $filters): int
    {
        return Project::where('user_id', $userId)
            ->when($filters->status, fn(Builder $query, ProjectStatus $status) => $query->where('status', $status))
            ->when($filters->title, fn(Builder $query, string $title) => $query->where('title', 'like', '%' . $title . '%'))
            ->count();
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
