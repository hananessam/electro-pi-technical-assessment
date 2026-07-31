<?php

namespace Modules\Project\Services;

use Modules\Project\Repositories\Contracts\ProjectInterface;

class ProjectService
{
    public function __construct(private ProjectInterface $projectRepository) {}
}
