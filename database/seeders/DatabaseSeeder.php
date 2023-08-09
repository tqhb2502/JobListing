<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
        ]);
        $users = User::factory(10)->create();

        Company::factory()->create([
            'name' => 'Test Company',
            'email' => 'company@example.com',
        ]);
        Company::factory(10)->create();

        Job::factory(20)->create()->each(function ($job) use ($users) {
            $job->users()->attach($users->random(2), [
                'created_at' => fake()->dateTimeBetween(date('Y-m-d', strtotime('-2 week')), now()),
                'updated_at' => now(),
            ]);
        });
    }
}
