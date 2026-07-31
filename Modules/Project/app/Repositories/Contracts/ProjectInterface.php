<?php

namespace Modules\Project\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\Project\Models\Project;

interface ProjectInterface
{
    public function allForUser(int $userId): Collection;

    /**
     * @param  array{name: string, description?: string, status?: string}  $data
     */
    public function create(array $data): Project;
}
