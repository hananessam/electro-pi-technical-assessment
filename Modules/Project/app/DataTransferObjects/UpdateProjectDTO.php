<?php

namespace Modules\Project\DataTransferObjects;

use Modules\Project\Enums\ProjectStatus;
use Modules\Project\Http\Requests\UpdateProjectRequest;

final readonly class UpdateProjectDTO
{
    public function __construct(
        public ?string $name = null,
        public ?string $description = null,
        public ?ProjectStatus $status = null,
    ) {}

    public static function fromRequest(UpdateProjectRequest $request): self
    {
        $validated = $request->validated();

        return new self(
            name: $validated['name'] ?? null,
            description: $validated['description'] ?? null,
            status: isset($validated['status']) ? ProjectStatus::from($validated['status']) : null,
        );
    }

    /**
     * @return array{name?: string, description?: string, status?: ProjectStatus}
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
        ], fn (mixed $value): bool => $value !== null);
    }
}
