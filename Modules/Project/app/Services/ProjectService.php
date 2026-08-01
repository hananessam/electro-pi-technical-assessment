<?php

namespace Modules\Project\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Project\DataTransferObjects\ProjectDTO;
use Modules\Project\DataTransferObjects\ProjectFilters;
use Modules\Project\DataTransferObjects\UpdateProjectDTO;
use Modules\Project\Models\Project;
use Modules\Project\Repositories\Contracts\ProjectInterface;

class ProjectService
{
    public function __construct(private ProjectInterface $projectRepository) {}

    public function listForUser(int $userId, ProjectFilters $filters): LengthAwarePaginator
    {
        return $this->projectRepository->allForUser($userId, $filters->perPage ?? 15);
    }

    public function find(int $id): ?Project
    {
        return $this->projectRepository->find($id);
    }

    public function create(ProjectDTO $data): Project
    {
        return $this->projectRepository->create($data);
    }

    public function update(Project $project, UpdateProjectDTO $data): Project
    {
        return $this->projectRepository->update($project, $data);
    }

    public function delete(Project $project): void
    {
        $this->projectRepository->delete($project);
    }
}
