<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
            'username' => $this->faker->userName(),
            'password' => Hash::make(1234),
            'role' => 'field-manager',
            'created_by' => $this->faker->numberBetween(3, 4),
            'updated_by' => $this->faker->numberBetween(3, 4),
        ];
    }

    public function teamField()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'team-field',
            ];
        });
    }

    public function manager()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'manager',
            ];
        });
    }

}
