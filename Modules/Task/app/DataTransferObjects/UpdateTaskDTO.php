<?php

namespace Modules\Task\DataTransferObjects;

use Modules\Task\Enums\TaskPriority;
use Modules\Task\Enums\TaskStatus;
use Modules\Task\Http\Requests\UpdateTaskRequest;

final readonly class UpdateTaskDTO
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?TaskStatus $status = null,
        public ?TaskPriority $priority = null,
        public ?string $dueDate = null,
    ) {}

    public static function fromRequest(UpdateTaskRequest $request): self
    {
        $validated = $request->validated();

        return new self(
            title: $validated['title'] ?? null,
            description: $validated['description'] ?? null,
            status: isset($validated['status']) ? TaskStatus::from($validated['status']) : null,
            priority: isset($validated['priority']) ? TaskPriority::from($validated['priority']) : null,
            dueDate: isset($validated['due_date']) ? $validated['due_date'] : null,
        );
    }

    /**
     * @return array{title?: string, description?: string, status?: TaskStatus, priority?: TaskPriority, due_date?: string}
     */
    public function toArray(): array
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => $this->dueDate,
        ], fn (mixed $value): bool => $value !== null);
    }
}
