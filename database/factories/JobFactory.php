<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyIds = Company::all()->pluck('id')->toArray();

        return [
            'company_id' => Arr::random($companyIds),
            'title' => fake()->jobTitle(),
            'min_salary' => rand(1000000, 15000000),
            'max_salary' => rand(15000000, 40000000),
            'job_nature' => rand(0, 1),
            'vacancy' => rand(2, 100),
            'location' => fake()->address(),
            'position' => fake()->jobTitle(),
            'description' => fake()->paragraph(10),
            'expires_at' => fake()->dateTimeBetween(now(), date('Y-m-d', strtotime('+2 month'))),
            'created_at' => fake()->dateTimeBetween(date('Y-m-d', strtotime('-2 month')), now()),
            'applied' => 2,
        ];
    }
}
