<?php

namespace Modules\Project\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Project\Enums\ProjectStatus;
use Modules\Project\Models\Project;

class ProjectDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userOne = User::firstWhere('email', 'test@example.com') ?? User::factory()->create(['email' => 'test@example.com']);
        $userTwo = User::firstWhere('email', 'test2@example.com') ?? User::factory()->create(['email' => 'test2@example.com']);

        Project::factory()->create([
            'user_id' => $userOne->id,
            'name' => 'Website Redesign',
            'status' => ProjectStatus::Active,
        ]);

        Project::factory()->create([
            'user_id' => $userOne->id,
            'name' => 'Mobile App Launch',
            'status' => ProjectStatus::Active,
        ]);

        Project::factory()->create([
            'user_id' => $userOne->id,
            'name' => 'Q1 Marketing Campaign',
            'status' => ProjectStatus::Completed,
        ]);

        Project::factory()->create([
            'user_id' => $userOne->id,
            'name' => 'Legacy System Migration',
            'status' => ProjectStatus::Archived,
        ]);

        Project::factory()->create([
            'user_id' => $userTwo->id,
            'name' => 'API Integration Platform',
            'status' => ProjectStatus::Active,
        ]);

        Project::factory()->create([
            'user_id' => $userTwo->id,
            'name' => 'Customer Support Portal',
            'status' => ProjectStatus::Active,
        ]);

        Project::factory()->create([
            'user_id' => $userTwo->id,
            'name' => 'Internal Tooling Revamp',
            'status' => ProjectStatus::Completed,
        ]);

        // Other users' projects, so ownership scoping has something to be tested against.
        Project::factory()->count(5)->create();
    }
}
