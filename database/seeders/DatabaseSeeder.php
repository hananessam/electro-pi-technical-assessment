<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Project\Database\Seeders\ProjectDatabaseSeeder;
use Modules\Task\Database\Seeders\TaskDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Second User',
            'email' => 'test2@example.com',
        ]);

        $this->call([
            ProjectDatabaseSeeder::class,
            TaskDatabaseSeeder::class,
        ]);
    }
}
