<?php

namespace Modules\Project\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ProjectInterface
{
    public function allForUser(int $userId): Collection;
}
