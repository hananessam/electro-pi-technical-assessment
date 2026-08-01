<?php

namespace Modules\Project\DataTransferObjects;

use Modules\Project\Enums\ProjectStatus;
use Modules\Project\Http\Requests\IndexProjectRequest;

final readonly class ProjectFilters
{
    public function __construct(
        public ?ProjectStatus $status = null,
        public ?string $title = null,
    ) {}

    public static function fromRequest(IndexProjectRequest $request): self
    {
        $validated = $request->validated();

        return new self(
            status: isset($validated['status']) ? ProjectStatus::from($validated['status']) : null,
            title: $validated['title'] ?? null,
        );
    }
}
