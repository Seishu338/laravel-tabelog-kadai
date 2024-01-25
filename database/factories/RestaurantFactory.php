<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pre = fake()->prefecture();
        $str = fake()->streetAddress();
        $address = $pre . $str;

        return [
            'category_id' => fake()->numberBetween(1, 46),
            'name' => fake()->country(),
            'description' => fake()->realText(),
            'starting_time' => 90000,
            'ending_time' => 210000,
            'price' => 1000,
            'postal_code' => fake()->postcode(),
            'address' => $address,
            'phone' => fake()->phoneNumber()
        ];
    }
}
