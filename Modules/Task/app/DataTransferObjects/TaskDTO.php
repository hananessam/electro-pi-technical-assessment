<?php

namespace Modules\Task\DataTransferObjects;

use Modules\Task\Enums\TaskPriority;
use Modules\Task\Enums\TaskStatus;
use Modules\Task\Http\Requests\StoreTaskRequest;

final readonly class TaskDTO
{
    public function __construct(
        public int $projectId,
        public string $title,
        public ?string $description,
        public TaskStatus $status,
        public TaskPriority $priority,
        public ?string $dueDate,
    ) {}

    public static function fromRequest(StoreTaskRequest $request): self
    {
        $validated = $request->validated();

        return new self(
            projectId: $validated['project_id'],
            title: $validated['title'],
            description: $validated['description'] ?? null,
            status: TaskStatus::from($validated['status']),
            priority: TaskPriority::from($validated['priority']),
            dueDate: isset($validated['due_date']) ? $validated['due_date'] : null,
        );
    }

    /**
     * @return array{project_id: int, title: string, description?: string, status: TaskStatus, priority: TaskPriority, due_date?: string}
     */
    public function toArray(): array
    {
        return array_filter([
            'project_id' => $this->projectId,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => $this->dueDate,
        ], fn (mixed $value): bool => $value !== null);
    }
}
