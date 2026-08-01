<?php

namespace Modules\Project\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Project\DataTransferObjects\ProjectDTO;
use Modules\Project\DataTransferObjects\ProjectFilters;
use Modules\Project\DataTransferObjects\UpdateProjectDTO;
use Modules\Project\Models\Project;

interface ProjectInterface
{
    public function allForUser(int $userId, int $perPage = 15): LengthAwarePaginator;

    public function countForUser(int $userId, ProjectFilters $filters): int;

    public function find(int $id): ?Project;

    public function create(ProjectDTO $data): Project;

    public function update(Project $project, UpdateProjectDTO $data): Project;

    public function delete(Project $project): void;
}
