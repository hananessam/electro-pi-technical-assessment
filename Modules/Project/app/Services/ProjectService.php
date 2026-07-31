<?php

namespace Modules\Project\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Project\Repositories\Contracts\ProjectInterface;

class ProjectService
{
    public function __construct(private ProjectInterface $projectRepository) {}

    public function listForUser(int $userId): Collection
    {
        return $this->projectRepository->allForUser($userId);
    }
}
