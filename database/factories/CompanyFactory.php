<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private $coverImages;

    public function definition(): array
    {
        $this->coverImages = File::allFiles(public_path('img/company_cover'));

        return [
            'email' => fake()->unique()->companyEmail(),
            'email_verified_at' => now(),
            'password' => '1',
            'name' => fake()->company(),
            'website' => fake()->url(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'description' => fake()->paragraph(10),
            'remember_token' => Str::random(10),
            'cover_image' => function () {
                $absolutePath = Arr::random($this->coverImages)->getPathname();
                $absolutePath = str_replace('\\', '/', $absolutePath);
                $index = strpos($absolutePath, 'public');
                return substr($absolutePath, $index + 7);
            },
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
