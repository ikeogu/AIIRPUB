<?php

use App\Enums\HttpStatusCode;
use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

it('has article/update page', function () {
    $user = actingAs();
    $article = Article::factory()->create();
    Storage::fake('articles');
    $file = UploadedFile::fake()->create('article.pdf', 1000, 'application/pdf');
    $data = [
        'title' => fake()->title(),
        'abstract' => fake()->text(),
        'authors_name' => fake()->name(),
        'no_page' => '3 - 10',
        'authors_email' => fake()->email(),
        'keywords' => fake()->word(),
        'other_authors_name' => [fake()->name(), fake()->name()],
        'other_authors_email' => [fake()->email(), fake()->email()],
        'attachment' => $file,
        'accepted' => fake()->date(),
        'status' => true,
        'received' => fake()->date(),
    ];

    $response = $this->put(route('articles.update', ['article' => $article]), $data)
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);

    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Article updated successfully');
});