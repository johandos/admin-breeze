<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'surname' => $this->faker->lastName,
            'dni' => $this->faker->unique()->numerify('########').$this->faker->randomLetter,
            'phone' => $this->faker->optional()->numerify('+###########'),
            'country' => $this->faker->optional()->country,
            'iban' => 'ES' . $this->faker->numerify('##') . $this->faker->numerify('####') . $this->faker->numerify('####') . $this->faker->numerify('##') . $this->faker->numerify('##########'),
            'about' => $this->faker->optional()->text(250),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
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
