<?php

use App\Enums\HttpStatusCode;
use App\Models\Article;

use function Pest\Laravel\assertDatabaseCount;

it('has article/fetch all', function () {
    $user = actingAs();
    Article::factory(10)->create();

    $response = $this->get(route('articles.index'))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);
    assertDatabaseCount('journals', 10);
    expect($response['message'])->toBe('All articles');
});

it('has article/fetch one', function () {
    $user = actingAs();
    $article = Article::factory()->create();

    $response = $this->get(route('articles.show', ['article' => $article]))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);
    assertDatabaseCount('articles', 1);
    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Article details');
});