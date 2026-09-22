<?php

namespace Database\Factories;

use App\Models\Academic\Elective;
use App\Models\School\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => (string) Str::uuid(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['student']),
            'fname' => fake()->firstName(),
            'mname' => fake()->optional(0.7)->lastName(), // 70% chance of having a middle name
            'lname' => fake()->lastName(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'contact' => fake()->phoneNumber(),
            'account_status' => fake()->randomElement(['active', 'inactive']),
            'school_id' => School::inRandomOrder()->value('school_id'),
            'elective_id' => Elective::inRandomOrder()->value('elective_id'),
            'email_verified_at' => now(),
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

    /**
     * State for specific roles (e.g., Student).
     */
    public function student(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'student',
        ]);
    }

    /**
     * State for active account status.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'account_status' => 'active',
        ]);
    }
}
