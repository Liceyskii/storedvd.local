<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PromoCode>
 */
class PromoCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        return [
            'code' => substr(str_shuffle($permitted_chars), 0, 10),
            'procent_discount' => $this->faker->numberBetween(10, 100)
        ];
    }
}
