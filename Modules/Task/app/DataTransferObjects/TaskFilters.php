<?php

namespace Modules\Task\DataTransferObjects;

use Modules\Task\Enums\TaskPriority;
use Modules\Task\Enums\TaskStatus;
use Modules\Task\Http\Requests\IndexTaskRequest;

final readonly class TaskFilters
{
    public function __construct(
        public ?TaskStatus $status = null,
        public ?TaskPriority $priority = null,
        public ?string $title = null,
        public ?int $perPage = null,
    ) {}

    public static function fromRequest(IndexTaskRequest $request): self
    {
        $validated = $request->validated();

        return new self(
            status: isset($validated['status']) ? TaskStatus::from($validated['status']) : null,
            priority: isset($validated['priority']) ? TaskPriority::from($validated['priority']) : null,
            title: $validated['title'] ?? null,
            perPage: $validated['per_page'] ?? null,
        );
    }
}
