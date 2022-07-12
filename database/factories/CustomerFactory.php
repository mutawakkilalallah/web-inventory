<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => $this->faker->regexify('[A-Z]{5}[0-9]{3}[A-Z]{5}[0-9]{3}'),
            'name' => $this->faker->name(),
            'address' => $this->faker->citySuffix(),
            'latitude' => null,
            'longitude' => null,
            'status' => 'old',
            'device_id' => null,
            'created_by' => $this->faker->numberBetween(1, 2),
            'updated_by' => $this->faker->numberBetween(3, 4),
        ];
    }

    public function newCustomer()
    {
        return $this->state(function (array $attributes) {
            return [
                'latitude' => $this->faker->latitude($min = -90, $max = 90),
                'longitude' => $this->faker->longitude($min = -180, $max = 180),
                'status' => 'new',
                'device_id' => $this->faker->numberBetween(10, 12),
                'created_by' => $this->faker->numberBetween(3, 4),
                'updated_by' => $this->faker->numberBetween(3, 4),
            ];
        });
    }
}
