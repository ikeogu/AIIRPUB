<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Editor>
 */
class EditorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name,
            'title' => $this->faker->title,
            'qualification' => $this->faker->sentence,
            'employed_at' => $this->faker->company,
            'email' => $this->faker->email,
            'number_of_publications' => 10,
        ];
    }
}
