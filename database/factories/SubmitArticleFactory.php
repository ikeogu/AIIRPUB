<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubmitArticle>
 */
class SubmitArticleFactory extends Factory
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
            'authors_name' => $this->faker->name,
            'authors_email' => $this->faker->email,
            'title_of_article' => $this->faker->sentence,
            'country' => $this->faker->country,
            'article'=> $this->faker->imageUrl,
            'status' => 'pending'
        ];
    }
}