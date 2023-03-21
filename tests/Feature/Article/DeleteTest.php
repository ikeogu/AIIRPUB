<?php

use App\Enums\HttpStatusCode;
use App\Models\Article;

it('has article/delete', function () {
    $user = actingAs();
    $article = Article::factory()->create();

    $response = $this->delete(route('articles.destroy', ['article' => $article->id]))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);

    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Article deleted successfully');
});
