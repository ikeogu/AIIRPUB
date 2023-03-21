<?php

namespace Database\Factories;

use App\Models\Journal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        Storage::fake('articles');
        $file = UploadedFile::fake()->create('article.pdf', 1000, 'application/pdf');
        return [
            //
            'title' => fake()->title(),
            'abstract' => fake()->text(),
            'authors_name' => fake()->name(),
            'no_page' => '3 - 10',
            'authors_email' => fake()->email(),
            'keywords' => fake()->word(),
            'journal_id' => Journal::factory()->create(),
            'other_authors_name' => [fake()->name(), fake()->name()],
            'other_authors_email' => [fake()->email(), fake()->email()],
            'attachment' => $file,
            'accepted' => fake()->date(),
            'status' => true,
            'received' => fake()->date(),
        ];
    }
}