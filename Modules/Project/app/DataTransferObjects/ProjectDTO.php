<?php

namespace Modules\Project\DataTransferObjects;

use Modules\Project\Enums\ProjectStatus;
use Modules\Project\Http\Requests\StoreProjectRequest;

final readonly class ProjectDTO
{
    public function __construct(
        public int $userId,
        public string $name,
        public ?string $description,
        public ?ProjectStatus $status,
    ) {}

    public static function fromRequest(StoreProjectRequest $request, int $userId): self
    {
        $validated = $request->validated();

        return new self(
            userId: $userId,
            name: $validated['name'],
            description: $validated['description'] ?? null,
            status: isset($validated['status']) ? ProjectStatus::from($validated['status']) : null,
        );
    }

    /**
     * @return array{user_id: int, name: string, description?: string, status?: ProjectStatus}
     */
    public function toArray(): array
    {
        return array_filter([
            'user_id' => $this->userId,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
        ], fn (mixed $value): bool => $value !== null);
    }
}
