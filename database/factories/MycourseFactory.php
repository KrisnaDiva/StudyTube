<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mycourse>
 */
class MycourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => mt_rand(2,10),
            'course_id' => mt_rand(1,10),
            'subject' => fake()->word(),
            'code' => mt_rand(000000,999999),
        ];
    }
}
