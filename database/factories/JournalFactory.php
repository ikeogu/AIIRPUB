<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Journal>
 */
class JournalFactory extends Factory
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
            'name' => fake()->name(),
            'volume' => 3,
            'issue' => 'rwrw44-42',
            'year' => '2021',
            'month' => 'Feb',
            'issn' => '4wee',
            'category_id' => Category::factory()->create()
        ];
    }
}