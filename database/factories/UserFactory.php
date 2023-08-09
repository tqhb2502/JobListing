<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    /**
     * 0: male,
     * 1: female
     */
    private const GENDER_LIST = [0, 1];

    public function definition(): array
    {
        return [
            'email' => fake()->unique()->email(),
            'email_verified_at' => now(),
            'password' => '1', // password
            'name' => fake()->name(),
            'gender' => Arr::random(self::GENDER_LIST),
            'dob' => fake()->dateTimeBetween(
                date('Y-m-d', strtotime('-50 year')),
                date('Y-m-d', strtotime('-19 year'))
            ),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'cv_url' => 'upload/cv/example-cv.pdf',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
