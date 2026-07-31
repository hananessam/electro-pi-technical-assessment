<?php

namespace Modules\Project\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Project\Models\Project;
use Modules\Project\Repositories\Contracts\ProjectInterface;

class ProjectService
{
    public function __construct(private ProjectInterface $projectRepository) {}

    public function listForUser(int $userId): Collection
    {
        return $this->projectRepository->allForUser($userId);
    }

    /**
     * @param  array{name: string, description?: string, status?: string}  $data
     */
    public function create(array $data): Project
    {
        return $this->projectRepository->create($data);
    }
}
