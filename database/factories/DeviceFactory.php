<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
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
            'picture' => $this->faker->imageUrl(360, 360, true, true, 'jpg'),
            'mandatory' => $this->faker->imageUrl(360, 360, true, true, 'jpg'),
            'status' => 'onHand',
            'condition' => 'good',
            'type_id' => $this->faker->numberBetween(1, 9),
            'customer_id' => null,
            'created_by' => $this->faker->numberBetween(1, 2),
            'updated_by' => $this->faker->numberBetween(3, 4),
        ];
    }

    public function in()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'in',
                'condition' => null,
            ];
        });
    }

    public function onHandBad()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'onHand',
                'condition' => 'bad',
            ];
        });
    }

    public function outGood()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'out',
                'condition' => 'good',               
                'customer_id' => $this->faker->numberBetween(4, 6),
            ];
        });
    }
}
