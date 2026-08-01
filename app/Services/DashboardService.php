<?php

namespace App\Services;

use Modules\Project\DataTransferObjects\ProjectFilters;
use Modules\Project\Enums\ProjectStatus;
use Modules\Project\Repositories\Contracts\ProjectInterface;
use Modules\Task\DataTransferObjects\TaskFilters;
use Modules\Task\Enums\TaskStatus;
use Modules\Task\Repositories\Contracts\TaskInterface;

class DashboardService
{
    public function __construct(
        private ProjectInterface $projectRepository,
        private TaskInterface $taskRepository,
    ) {}

    /**
     * @return array{total_projects: int, active_projects: int, total_tasks: int, completed_tasks: int, pending_tasks: int, overdue_tasks: int}
     */
    public function summaryForUser(int $userId): array
    {
        return [
            'total_projects' => $this->projectRepository->countForUser($userId, new ProjectFilters()),
            'active_projects' => $this->projectRepository->countForUser($userId, new ProjectFilters(status: ProjectStatus::Active)),
            'total_tasks' => $this->taskRepository->countByUser($userId, new TaskFilters()),
            'completed_tasks' => $this->taskRepository->countByUser($userId, new TaskFilters(status: TaskStatus::Done)),
            'pending_tasks' => $this->taskRepository->countPendingByUser($userId),
            'overdue_tasks' => $this->taskRepository->countOverdueByUser($userId),
        ];
    }
}
