<?php

namespace Database\Factories;

use App\Enums\UserEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
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
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            // 'email' => $this->faker->unique()->email(),
            'email' => uniqid().'test@gmail.com',
            'phone' => $this->faker->unique()->numberBetween(12345678911,9999999999),
            'status' => UserEnum::CONFIRMED,
            'email_verified_at' => now(),
            'ip' => 1234,
            'password' => 'admin', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
